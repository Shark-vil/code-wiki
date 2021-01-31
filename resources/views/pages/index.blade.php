@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ Language::get('pages')->control_panel }}
                    <div class="float-right">
                        <a class="btn btn-outline-primary btn-sm" style="min-width: 100px"
                            href="{{ route('pages.create') }}">
                            {{ Language::get('pages')->add_page }}
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="float-left">
                        <select id="library_filter" onchange="onChangeLibraryFilter(this)" multiple>
                            <option value="Without library">Without library</option>
                            @php
                                $exists_library = [];
                            @endphp

                            @foreach ($pages as $page)
                                @if (!empty($page->library) && !in_array($page->library, $exists_library))
                                    <option value="{{ $page->library }}">{{ $page->library }}</option>
                                    @php
                                        array_push($exists_library, $page->library);
                                    @endphp
                                @endif
                            @endforeach
                        </select>

                        <hr>
                    </div>
                    <table id="main_table" class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ Language::get('categories')->table_library }}</th>
                            <th scope="col">{{ Language::get('categories')->table_name }}</th>
                            <th scope="col">{{ Language::get('categories')->table_edit }}</th>
                            <th scope="col">{{ Language::get('categories')->table_delete }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                            <tr>
                                <td scope="row">{{ $page->id }}</td>
                                <td>@if($page->library != null){{ $page->library }} @else Without library @endif</td>
                                <td>{{ $page->name }}</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" style="min-width: 100px"
                                        href="{{ route('pages.edit', $page->id) }}">
                                        {{ Language::get('categories')->table_edit }}
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" style="min-width: 100px"
                                        onclick="onDelete(this, {{ $page->id }})">
                                        {{ Language::get('categories')->table_delete }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#library_filter').multiselect();
        });

        var selected_library = [];

        function updateTableValuesVisibility() {
            $('#main_table tr').each(function() {
                var column = $(this);
                var rows = column.find('td');

                if (rows.length == 0)
                    return;

                if(selected_library.length != 0) {
                    var row_library = $.trim(rows.eq(1).text());
                    var isExist = false;

                    $.each(selected_library, function(key, value) {
                        if (value == row_library) {
                            column.css('visibility', 'visible');
                            isExist = true;
                            return;
                        }
                    });

                    if (!isExist)
                        column.css('visibility', 'collapse');
                } else {
                    column.css('visibility', 'visible');
                }
            });
        }

        function onChangeLibraryFilter(s) {
            selected_library = [];

            for (var option of s.options) {
                if (option.selected) {
                    selected_library.push(option.value);
                }
            }

            updateTableValuesVisibility();
        }

        function onDelete(editButton, id) {
            var cells = new CellsHelper(editButton);
            var data = {
                id: cells.getValue(0),
                api_token: "{{ Auth::user()->api_token }}"
            };

            $.ajax({
                url: ("{{ route('api.pages.delete', '%id') }}").replace('%id', id),
                type: "POST",
                data: data,
                success: function(response) {
                    cells.getRow().remove();
                    Toastify({
                        text: ("{{ Language::get('pages')->success_delete_message }}")
                            .replace('%library%', response.library)
                            .replace('%name%', response.name),
                        duration: 3000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                    }).showToast();
                },
                error: function(error) {
                    console.error(error)
                    Toastify({
                        text: "{{ Language::get('pages')->error_delete_message }}",
                        duration: 3000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #a32929, #c92424)",
                    }).showToast();
                },
            });
        }
    </script>    
@endsection
