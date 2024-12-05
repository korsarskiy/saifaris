@extends('layouts.app')


@section('content')
    <div class="admin-auth">
        <div class="container">
            <h2>Авторизация</h2>
            <form action="{{route('auth')}}" method="post">
                @csrf
                <div class="input-label">
                    <input type="text" name="login" placeholder="Логин">
                   @error('login') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="password" name="password" placeholder="Пароль">
                    @error('password') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                @error('auth') <label class="errlabel" for="">{{$message}}</label> @enderror
                <button class="input-label-button" type="submit">Войти</button>
            </form>
        </div>
    </div>


@endsection
