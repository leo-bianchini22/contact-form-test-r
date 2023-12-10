@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__ttl">
        Contact
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <!-- 名前 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">お名前</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text__name">
                    <span class="form__input-text__firstName">
                        <input type="text" name="first_name" placeholder="例:山田">
                    </span>
                    <span class="form__input-text__secondName">
                        <input type="text" name="last_name" placeholder="例:太郎">
                    </span>
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 性別 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">性別</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-radio">
                    <input type="radio" name="gender" value="男性" checked><label>男性</label>
                    <input type="radio" name="gender" value="女性"><label>女性</label>
                    <input type="radio" name="gender" value="その他"><label>その他</label>
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- メール -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">メールアドレス</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="email" name="email" placeholder="例:test@example.com">
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 電話番号 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">電話番号</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="tel" placeholder="例:08012345678">
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 住所 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">住所</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 建物名 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101">
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 問い合わせ種類 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">お問い合わせ内容の種類</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-select">
                    <select name="detail">
                        <option value="" selected hidden>選択してください</option>
                        <option value="商品のお届けについて">商品のお届けについて</option>
                        <option value="商品の交換について">商品の交換について</option>
                        <option value="商品トラブル">商品トラブル</option>
                        <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>
        <!-- 問い合わせ内容 -->
        <div class="form__group">
            <div class="form__groupe-ttl">
                <span class="form__label-item">お問い合わせ内容</span>
                <span class="form__label-required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input-text">
                    <textarea name="content" placeholder="お問い合わせ内容をご記入ください"></textarea>
                </div>
                <div class="form__error">
                    <!-- えらー -->
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection