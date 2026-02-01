@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
div class="container">

    <h1 class="page__title">商品登録</h1>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error__box">
            <ul class="error__list">
                @foreach ($errors->all() as $error)
                    <li class="error__item">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('products.store') }}"
        enctype="multipart/form-data"
        class="form"
    >
        @csrf

        {{-- 商品名 --}}
        <div class="form__group">
            <label class="form__label">商品名</label>
            <input
                type="text"
                name="name"
                class="form__input"
                value="{{ old('name') }}"
            >
        </div>

        {{-- 値段 --}}
        <div class="form__group">
            <label class="form__label">値段</label>
            <input
                type="number"
                name="price"
                class="form__input"
                value="{{ old('price') }}"
            >
        </div>

        {{-- 商品画像 --}}
        <div class="form__group">
            <label class="form__label">商品画像</label>
            <input
                type="file"
                name="image"
                class="form__file"
                accept=".png,.jpeg"
            >
        </div>

        {{-- 季節 --}}
        <div class="form__group">
            <label class="form__label">季節</label>
            <select name="season" class="form__select">
                <option value="">選択してください</option>
                <option value="spring" @selected(old('season') === 'spring')>春</option>
                <option value="summer" @selected(old('season') === 'summer')>夏</option>
                <option value="autumn" @selected(old('season') === 'autumn')>秋</option>
                <option value="winter" @selected(old('season') === 'winter')>冬</option>
            </select>
        </div>

        {{-- 商品説明 --}}
        <div class="form__group">
            <label class="form__label">商品説明</label>
            <textarea
                name="description"
                class="form__textarea"
                maxlength="120"
            >{{ old('description') }}</textarea>
        </div>

        {{-- ボタン --}}
        <div class="form__actions">
            <a href="{{ route('products.index') }}" class="btn btn--back">戻る</a>
            <button type="submit" class="btn btn--submit">登録</button>
        </div>

    </form>
</div>
@endsection