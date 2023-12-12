@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('login')
<a class="header__login" href="/register">register</a>
@endsection

@section('content')
<div class="login__content">
    <div class="login__ttl">
        Login
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-ttl">メールアドレス</div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-ttl">パスワード</div>
            <div class="form__group-content">
                <input type="password" name="password" placeholder="例:coachtech1106" />
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="login__button">
            <button class="login__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection