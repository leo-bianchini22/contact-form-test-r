@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('login')
<form class="header__logout" action="{{ route('logout') }}" method="post">
    @csrf
    <button class="header-logout__button" type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="admin__content">
    <div class="admin__ttl">
        Admin
    </div>
    <form class="search-form" action="/admin/search" method="get">
        @csrf
        <div class="search-form__item-content">
            <div class="search-form__item">
                <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <button class="search-form__button-submit" type="submit"><img src="{{ asset('img/search-icon.png') }}" alt=""></button>
            </div>
            <select class="search-form__item-select" name="gender">
                <option value="" hidden selected>性別</option>
                <option value="">全て</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select class="search-form__item-select" name="category_id">
                <option value="" selected>お問い合わせ内容の種類</option>
                @foreach ($categories as $category)
                <option id="category_id" value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input type="date" class="search-form__item-date" name="created_at">
        </div>
    </form>

    <div class="admin-table__content">
        <div class="admin-table__header">
            <form class="downloadCsv" action="{{'/export?'.http_build_query(request()->query())}}" method="post">
                @csrf
                <input class="export__btn btn" type="submit" value="エクスポート">
            </form>
            <div class="paginate">{{ $contacts->render('pagination::bootstrap-4') }}</div>
        </div>
        <div class="admin-table">
            <table class="admin-table__inner">
                <tr class="admin-table__row__ttl">
                    <td>お名前</td>
                    <td>性別</td>
                    <td>メールアドレス</td>
                    <td>お問い合わせの種類</td>
                    <td></td>
                </tr>
                @foreach($contacts as $contact)
                <tr class="admin-table__row">
                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>
                        <a class="modal-open" href="#{{$contact['id']}}">詳細</a>
                        <div class="modal" id="{{$contact['id']}}">
                            <div class="modal-wrapper">
                                <div class="modal-contents">
                                    <a href="#!" class="modal-close">✕</a>
                                    <div class="modal-content">
                                        <table class="modal-table">
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お名前</th>
                                                <td>{{$contact->first_name}} {{$contact->last_name}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">性別</th>
                                                <td>{{$contact->gender}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">メールアドレス</th>
                                                <td>{{$contact->email}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">電話番号</th>
                                                <td>{{$contact->tel}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">住所</th>
                                                <td>{{$contact->address}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">建物名</th>
                                                <td>{{$contact->building}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お問合せの種類</th>
                                                <td>{{$contact->category->content}}</td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お問合せ内容</th>
                                                <td>{{$contact->detail}}</td>
                                            </tr>
                                        </table>
                                        <form class="delete-form" action="/admin/delete" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                            <button type="submit" class="delete-button">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <form action="/admin/reset" method="get">
        <div class="admin__reset">
            <button name="reset">リセット</button>
        </div>
    </form>
</div>
@endsection