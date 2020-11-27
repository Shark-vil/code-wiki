@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Language::get('home')->control_panel }}</div>

                <div class="card-body">
                    <a href="{{ route('pages') }}">{{ Language::get('pages')->title }}</a><br>
                    <a href="{{ route('categories') }}">{{ Language::get('categories')->title }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
