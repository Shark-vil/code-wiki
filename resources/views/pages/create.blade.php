@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ Language::get('pages')->create_page_title }}</div>
                <div class="card-body">
                    <form class="form-group" id="create-form">
                        @csrf
                        
                        <label>{{ Language::get('pages')->any_page_form_library_name }}</label>
                        <input type="text" class="form-control"
                            name="library" aria-describedby="emailHelp" 
                            placeholder="{{ Language::get('pages')->any_page_form_library_name_help_text }}"
                            autocomplete="off">
                        
                        <br>

                        <label>{{ Language::get('pages')->any_page_form_name }}</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="{{ Language::get('pages')->any_page_form_name_help_text }}"
                            autocomplete="off">
                        
                        <br>

                        <label>{{ Language::get('pages')->any_page_form_category_name }}</label>
                        <select class="form-control" name="category">
                            <option value="" selected disabled hidden>{{ Language::get('pages')->any_page_form_category_name_help_text }}</option>
                            @foreach ($categories as $category)
                                <option>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <br>

                        <input type="checkbox" name="is_server"/>
                        <label>Is server function</label><br>

                        <input type="checkbox" name="is_client"/>
                        <label>Is client function</label><br>

                        <input type="checkbox" name="is_menu"/>
                        <label>Is menu function</label><br>

                        <hr>

                        <label>{{ Language::get('pages')->any_page_form_content_name }}</label>
                        <textarea id="content" name="content"></textarea>

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="{{ Language::get('pages')->create_page_form_submit }}"/>

                        <button type="button" 
                            class="btn btn-success preview-btn">{{ Language::get('pages')->any_page_form_preview }}</button>
                    </form>
                    
                    <h2>{{ Language::get('pages')->any_page_preview_content_name }}</h2>
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
                lang:'{{ env('APP_LANGUAGE') }}'
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
                            text: ("{{ Language::get('pages')->success_create_message }}")
                                .replace('%library%', response.library)
                                .replace('%name%', response.name),
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                        }).showToast();
                        window.location.href = ("{{ route('pages.edit', '%id') }}").replace('%id', response.id);
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "{{ Language::get('pages')->error_update_message }}",
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
