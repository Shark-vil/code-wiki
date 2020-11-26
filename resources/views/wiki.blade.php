@extends('layouts.wiki')

@section('content')
<div class="container-fluid">
    <div class="row flex">
        <div class="col-sm-3 bg-dark text-white">
            <div class="just-padding">
                <form method="get">
                    <input id="searchInput" class="form-control input-sm" 
                        type="text" />
                </form>
                <hr>
                <div id="methods-list" class="list-group list-group-root well">
                    @foreach ($wikiStorage as $key => $item)
                    @php
                        $htmlCategotyId = str_replace(' ', '_', mb_strtolower($item['category']->name)) 
                    @endphp

                    <a href="#{{ $htmlCategotyId }}" 
                        class="method-category list-group-item bg-dark text-white" 
                        data-toggle="collapse"

                    @php $categoryActive = '' @endphp
                    @if (!is_null($getPage) && $getPage->category_id == $item['category']->id)
                        aria-expanded="true"
                        @php $categoryActive = 'show' @endphp
                    @endif>{{ $item['category']->name }}
                    
                    <span class="badge badge-primary badge-pill float-right">{{ $item['libCount'] }}</span>
                    </a>
                    <div class="list-group collapse {{ $categoryActive }}" id="{{ $htmlCategotyId }}">

                        @foreach ($item['libraries'] as $library => $pages)
                        @php
                            $htmlLibraryId = str_replace(' ', '_', mb_strtolower($library)) 
                        @endphp
                        <a href="#{{ $htmlCategotyId . '-' . $htmlLibraryId }}" 
                            class="method-library list-group-item bg-dark text-white" 
                            data-toggle="collapse"

                            @php $libraryActive = '' @endphp
                            @if ($categoryActive && $getPage->library == $library)
                                aria-expanded="true"
                                @php $libraryActive = 'show' @endphp
                            @endif>

                            {{ $library }}
                        </a>
                        <div class="list-group collapse {{ $libraryActive }} bg-secondary text-white" id="{{ $htmlCategotyId . '-' . $htmlLibraryId }}">
                            @foreach ($pages as $key => $page)
                                <button class="method-page list-group-item bg-secondary text-white"
                                    onclick="loadInfo('{{ $page->id }}')">{{ $page->name }}</button>
                            @endforeach
                        </div>
                        @endforeach

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="wiki-content">
                @if (!is_null($getPage))
                    <br><h1 class='text-center'>{{ $getPage->library . '.' . $getPage->name }}</h1><hr>
                    {!! $getPage->content !!}
                @endif
            </div>
        </div>
      </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        Array.prototype.inArray = function(element) { 
            for(var i = 0; i < this.length; i++)
                if (this[i] == element) 
                    return true; 
            return false; 
        };

        function loadInfo(id) {
            $.ajax({
                url: ("{{ route('api.pages.get', '%id') }}").replace('%id', id),
                type: "GET",
                success: function(response) {
                    var library = response.library;
                    var name = response.name;

                    var nextURL = '{{ route('wiki') }}/'+ library + "." + name;
                    var nextTitle = 'Method - ' + library + "." + name;
                    var nextState = { additionalInformation: 'Open new method information' };
                    window.history.pushState(nextState, nextTitle, nextURL);

                    var header = "<br><h1 class='text-center'>" + library + "." + name + "</h1><hr>";
                    $('.wiki-content').empty().append(header);
                    $('.wiki-content').append(response.content);
                },
                error: function(error) {
                    console.error(error)
                    Toastify({
                        text: "Возникла ошибка при попытке получить контент страницы",
                        duration: 3000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #a32929, #c92424)",
                    }).showToast();
                },
            });
        }

        $(function() {
            function valueElementToId(val) {
                var element = val.toString().trim();
                element.replace('/\s/g', '_');
                element = element.split("\n").slice(0, 1).join("\n");
                element = element.toLowerCase();
                return element;
            };

            var allMethodsFinded = [];
            var categories = document.querySelector('#methods-list');
            var categoriesStorage = document.querySelectorAll('.method-category-storage');

            categories.querySelectorAll('.method-category').forEach(categoryElement => {
                var categoryNameId = valueElementToId(categoryElement.innerText);
                var libraries = document.querySelector('#' + categoryNameId);

                allMethodsFinded.push({
                    name: categoryNameId,
                    element: categoryElement,
                    main: categories,
                    parent: []
                })

                libraries.querySelectorAll('.method-library').forEach(libraryElement => {
                    var libraryNameId = valueElementToId(libraryElement.innerText);
                    var pages = document.querySelector('#' + categoryNameId + '-' + libraryNameId);

                    allMethodsFinded.push({
                        name: libraryNameId,
                        element: libraryElement,
                        main: libraries,
                        parent: [ categoryNameId ]
                    })
                    
                    pages.querySelectorAll('.method-page').forEach(postElement => {
                        var postNameId = valueElementToId(postElement.innerText);

                        allMethodsFinded.push({
                            name: postNameId,
                            element: postElement,
                            main: pages,
                            parent: [ libraryNameId, categoryNameId ]
                        })
                    });
                });
            });

            var a_elementsOpens = [];
            var div_elementsOpens = [];
            $('#searchInput').on('change paste keyup', function () {
                var findText = valueElementToId($(this).val());
                var whiteList = [];

                div_elementsOpens.forEach(element => {
                    element.classList.remove("show");
                });
                div_elementsOpens = [];

                a_elementsOpens.forEach(element => {
                    element.setAttribute("aria-expanded", "false");
                });
                a_elementsOpens = [];

                for (const [index, table] of Object.entries(allMethodsFinded)) {
                    if (findText.length != 0) {
                        if (table.name.search(findText) > -1) {
                            if (!whiteList.inArray(table.name)) {
                                whiteList.push(table.name);
                            }

                            table.parent.forEach(element => {
                                if (!whiteList.inArray(element)) {
                                    whiteList.push(element);
                                }
                            });
                        }
                    }
                }

                for (const [index, table] of Object.entries(allMethodsFinded)) {
                    if (findText.length == 0) {
                        table.element.style.display = "block";
                    } else {
                        if (table.name.search(findText) == -1 && !whiteList.includes(table.name))
                            table.element.style.display = "none";
                        else {
                            table.element.style.display = "block";

                            if (!a_elementsOpens.inArray(table.element)) {
                                if (table.element.getAttribute("aria-expanded") != 'true') {
                                    table.element.setAttribute("aria-expanded", "true");
                                    a_elementsOpens.push(table.element);
                                }
                            }

                            if (!div_elementsOpens.inArray(table.main)) {
                                if (!table.main.classList.contains("show")) {
                                    table.main.classList.add("show");
                                    div_elementsOpens.push(table.main);
                                }
                            } 
                        }
                    }
                }
            });
        });
    </script>    
@endsection
