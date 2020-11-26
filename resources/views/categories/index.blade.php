@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Список категорий
                    <div class="float-right">
                        <a class="btn btn-outline-primary btn-sm" 
                            href="{{ route('categories.create') }}">
                            Добавить категорию
                        </a>
                    </div>
                </div>
                
                <div class="card-body">                        
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Редактировать</th>
                            <th scope="col">Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td scope="row">{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a class="btn btn-outline-primary btn-sm" 
                                        href="{{ route('categories.edit', $category->id) }}">
                                        Редактировать
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm" 
                                        onclick="onDelete(this, {{ $category->id }})">
                                        Удалить
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
        function onDelete(editButton, id) {
            var cells = new CellsHelper(editButton);
            var data = {
                id: cells.getValue(0),
                api_token: "{{ Auth::user()->api_token }}"
            };

            $.ajax({
                url: ("{{ route('api.categories.delete', '%id') }}").replace('%id', id),
                type: "POST",
                data: data,
                success: function(response) {
                    cells.getRow().remove();
                    Toastify({
                        text: "Категория '" + response.name + "' успешно удалена",
                        duration: 3000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #3c942b, #39ba20)",
                    }).showToast();
                },
                error: function(error) {
                    console.error(error)
                    Toastify({
                        text: "Возникла ошибка при попытке удалить категорию",
                        duration: 3000,
                        close: true,
                        backgroundColor: "linear-gradient(to right, #a32929, #c92424)",
                    }).showToast();
                },
            });
        }
    </script>    
@endsection
