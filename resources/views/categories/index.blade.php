@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Список категорий</div>
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
                                <td><button onclick="onEdit(this, {{ $category->id }})">Редактировать</button></td>
                                <td><button onclick="onDelete(this, {{ $category->id }})">Удалить</button></td>
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
        function onEdit(editButton, id) {
            var cells = new CellsHelper(editButton);
            var data = {
                id: cells.getValue(0),
                name: cells.getValue(1),
                api_token: "{{ Auth::user()->api_token }}"
            };
            /*
            $.ajax({
                url: "{{ route('home') }}",
                type: "POST",
                data: data,
                success(function(response) {
                    alert(response);
                }),
                error(function() {

                }),
            });
            */
        }
    </script>    
@endsection
