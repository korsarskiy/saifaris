@extends('layouts.app')

@section('content')
    <div class="not-found-page">
        <div class="not-found-items">
                <h1>4 <span>0</span> 4</h1>
            <p>Страница не найдена!</p>
            <a href="{{route('index')}}">На Главную →</a>
            <a href="{{route('catalog')}}">В Каталог →</a>
        </div>
    </div>
@endsection
