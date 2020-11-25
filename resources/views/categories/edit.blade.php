@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Редактирование категории #{{ $category->id }}</div>
                <div class="card-body">
                    <form class="form-group" id="edit-form">
                        @csrf
                        
                        <label>Название категории</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="Введите наименование категории"
                            value="{{ $category->name }}" autocomplete="off">

                        <input type="hidden" name="id" 
                            value="{{ $category->id }}"/>

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="Обновить"/>
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
                        console.log(response);
                        if (response.id == {{ $category->id }}) {
                            Toastify({
                                text: "Категория '" + currentName + "' изменена на '" + response.name + "'",
                                duration: 3000,
                                close: true,
                                backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                            }).showToast();
                            currentName = response.name;
                        }
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "Возникла ошибка при попытке обновить категорию",
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
