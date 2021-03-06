@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ Language::get('categories')->edit_page_title . $category->id }}</div>
                <div class="card-body">
                    <form class="form-group" id="edit-form">
                        @csrf
                        
                        <label>{{ Language::get('categories')->any_page_form_category_name }}</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="{{ Language::get('categories')->any_page_form_category_name_help_text }}"
                            value="{{ $category->name }}" autocomplete="off">

                        <input type="hidden" name="id" 
                            value="{{ $category->id }}"/>

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="{{ Language::get('categories')->edit_page_form_submit }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function() {
            var currentName = '{{ $category->name }}';

            $("#edit-form").submit(function(e) {
                e.preventDefault();

                var form = $(this);
                $.ajax({
                    url: ("{{ route('api.categories.update', $category->id ) }}"),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        Toastify({
                            text: ("{{ Language::get('categories')->success_update_message }}")
                                .replace('%old_name%', currentName)
                                .replace('%name%', response.name),
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                        }).showToast();
                        currentName = response.name;
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "{{ Language::get('categories')->error_update_message }}",
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
