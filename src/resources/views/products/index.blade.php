@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="container">
    <div class="content__wrapper">

        {{-- 左サイドバー --}}
        <aside class="sidebar">
            <h1 class="sidebar__title">商品一覧</h1>

            <form method="GET" action="{{ route('products.index') }}" class="search__area">
                <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button type="submit">検索</button>

                <p class="sort__title">価格順で表示</p>
                <select name="sort" class="sort__select {{ request('sort') ? 'is-selected' : '' }}" onchange="this.form.submit()">
                    <option value="" disabled selected>価格で並べ替え</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                        価格が安い順
                    </option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                        価格が高い順
                    </option>
                </select>
                <p class="search__area--line"></p>
            </form>
        </aside>

        {{-- 右：商品一覧 --}}
        <main class="main__content">
            <div class="page__header">
                <a href="{{ route('products.create') }}" class="btn-primary">
                    + 商品を追加
                </a>
            </div>

            <div class="product__list">
                @foreach ($products as $product)
                    <div class="product__card">
                        <img src="{{ asset('storage/image/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product__info">
                            <p class="product__name">{{ $product->name }}</p>
                            <p class="product__price">¥{{ $product->price }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
        </main>

    </div>
</div>

@endsection