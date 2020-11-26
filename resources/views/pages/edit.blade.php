@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактирование поста</div>
                <div class="card-body">
                    <form class="form-group" id="edit-form">
                        @csrf
                        
                        <label>Название библиотеки</label>
                        <input type="text" class="form-control"
                            name="library" aria-describedby="emailHelp" 
                            placeholder="Введите наименование библиотеки"
                            autocomplete="off" value="{{ $page->library }}">
                        
                        <br>

                        <label>Название функции</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="Введите наименование функции"
                            autocomplete="off" value="{{ $page->name }}">
                        
                        <br>

                        <label>Категория</label>
                        <select class="form-control" name="category">
                            <option value="" selected disabled hidden>Выберите категорию</option>
                            @foreach ($categories as $category)
                                @php
                                    if ($category->id == $page->category_id)
                                        echo "<option selected>".  $category->name . "</option>";
                                    else
                                        echo "<option>".  $category->name . "</option>";
                                @endphp
                            @endforeach
                        </select>

                        <br>

                        <label>Документация</label>
                        <textarea id="content" name="content">{{ $page->content }}</textarea>

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="Сохранить"/>

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
                prettyPrint();
                return $('#content').summernote('code');
            };

            $('#content').summernote({
                height: 250,
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

            $("#edit-form").submit(function(e) {
                e.preventDefault();

                var form = $(this);

                console.log(form.serializeArray());

                $.ajax({
                    url: ("{{ route('api.pages.update', $category->id ) }}"),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response);
                        Toastify({
                            text: "Страница '"+ response.library + "." + response.name  + "' была успешно обновлена",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                        }).showToast();
                        nameInput.val('');
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "Возникла ошибка при попытке обновить страницу",
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
