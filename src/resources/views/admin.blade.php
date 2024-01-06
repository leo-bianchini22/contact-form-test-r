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
    <form class="form" action="/admin/search" method="get">
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
        <div class="admin-table__header">
            <a href="">エクスポート</a>
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
                        <div class="modal-open"><a href="#modal">詳細</a></div>
                        <div class="modal" id="modal">
                            <div class="modal-wrapper">
                                <div class="modal-contents">
                                    <a href="#!" class="modal-close">✕</a>
                                    <div class="modal-content">
                                        <table class="modal-table">
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お名前</th>
                                                <td class="modal-table__text-name">
                                                    <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly>
                                                    <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">性別</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">メールアドレス</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="email" value="{{ $contact['email'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">電話番号</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">住所</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">建物名</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お問い合わせの種類</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="category_id" value="{{ $contact['category_id'] }}" readonly>
                                                </td>
                                            </tr>
                                            <tr class="modal-table__row">
                                                <th class="modal-table__ttl">お問い合わせ内容</th>
                                                <td class="modal-table__text">
                                                    <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="delete">
                                            <button type="delete" class="delete-button">削除</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="admin__reset">
            <button name="reset">リセット</button>
        </div>
    </form>
</div>
@endsection