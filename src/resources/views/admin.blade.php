@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('login')
<form class="header__logout" action="/auth/login" method="post">
    <button class="header-logout__button">ログアウト</button>
</form>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__ttl">
        Admin
    </div>
    <form action="admin" method="post">
    @csrf

    </form>
</div>
@endsection