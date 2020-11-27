@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создание поста</div>
                <div class="card-body">
                    <form class="form-group" id="create-form">
                        @csrf
                        
                        <label>Название библиотеки</label>
                        <input type="text" class="form-control"
                            name="library" aria-describedby="emailHelp" 
                            placeholder="Введите наименование библиотеки"
                            autocomplete="off">
                        
                        <br>

                        <label>Название функции</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="Введите наименование функции"
                            autocomplete="off">
                        
                        <br>

                        <label>Категория</label>
                        <select class="form-control" name="category">
                            <option value="" selected disabled hidden>Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <br>

                        <label>Документация</label>
                        <textarea id="content" name="content"></textarea>

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="Создать"/>

                        <button type="button" 
                            class="btn btn-success preview-btn">Предпросмотр</button>
                    </form>
                    
                    <h2>Область предпросмотра</h2>
                    <hr>
                    <div id="preview-box"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            function compilePost() {
                // prettyPrint();
                document.querySelectorAll('pre code').forEach((block) => {
                    hljs.highlightBlock(block);
                });
                return $('#content').summernote('code');
            };

            $('#content').summernote({
                height: 300,
                tabsize: 2,
                prettifyHtml: false,
                toolbar:[
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']],
                    ['highlight', ['highlight']],
                ],
                lang:'ru-RU'
            });

            $('.preview-btn').click(function () {
                $('#preview-box').html(compilePost());
            });

            $("#create-form").submit(function(e) {
                e.preventDefault();
                $("#edit-form textarea[id=content]").val(compilePost())

                var form = $(this);

                $.ajax({
                    url: ("{{ route('api.pages.create') }}"),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        Toastify({
                            text: "Страница '"+ response.library + "." + response.name  + "' была успешно создана",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                        }).showToast();
                        window.location.href = ("{{ route('pages.edit', '%id') }}").replace('%id', response.id);
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "Возникла ошибка при попытке создать страницу",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #a32929, #c92424)",
                        }).showToast();
                    },
                });
            });
        });
    </script>    
@endsection
