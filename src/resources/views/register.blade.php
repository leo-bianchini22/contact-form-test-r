@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('login')
<a class="header__login" href="/login">login</a>
@endsection

@section('content')
<div class="register__content">
    <div class="register__ttl">
        Register
    </div>
    <form class="form" action="">
        <div class="form__group">
            <div class="form__group-ttl">お名前</div>
            <div class="form__group-content">
                <input type="text" name="name" placeholder="例:山田  太郎">
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-ttl">メールアドレス</div>
            <div class="form__group-content">
                <input type="email" name="email" placeholder="例:test@example.com">
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-ttl">パスワード</div>
            <div class="form__group-content">
                <input type="password" name="password" placeholder="例:coachtech1106">
            </div>
        </div>
        <div class="register__button">
            <button class="register__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection