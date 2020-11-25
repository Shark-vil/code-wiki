@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создание категории</div>
                <div class="card-body">
                    <form class="form-group" id="edit-form">
                        @csrf
                        
                        <label>Название категории</label>
                        <input type="text" class="form-control"
                            name="name" aria-describedby="emailHelp" 
                            placeholder="Введите наименование категории"
                            autocomplete="off">

                        <input type="hidden" name="api_token" 
                            value="{{ Auth::user()->api_token }}"/>

                        <hr>
                        
                        <input type="submit" class="btn btn-primary" 
                            value="Создать"/>
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
            $("#edit-form").submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var nameInput = $("[name='name']");

                $.ajax({
                    url: ("{{ route('api.categories.create') }}"),
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response);
                        Toastify({
                            text: "Категория '" + response.name  + "' была успешно создана",
                            duration: 3000,
                            close: true,
                            backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                        }).showToast();
                        nameInput.val('');
                    },
                    error: function(error) {
                        console.error(error)
                        Toastify({
                            text: "Возникла ошибка при попытке создать категорию",
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
