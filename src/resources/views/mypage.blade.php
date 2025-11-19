@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="content__profile">
    <div class="profile__item">
        <div class="profile__item--icon">
            @if (Auth::user()->icon)
            <img src="{{ asset('storage/' . Auth::user()->icon) }}" alt="ユーザーアイコン" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
            @else
            <img src="{{ asset('img/default-icon.png') }}" style="width: 100px; height: 100px; border-radius: 50%;">
            @endif
        </div>
        <div class="profile__item--profile">
            <div class="profile__item--name">
                {{ Auth::user()->name }}
            </div>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $ratingStars)
                        <span class="star filled">★</span>
                    @else
                        <span class="star">☆</span>
                    @endif
                @endfor
            </div>
        </div>
    </div>
    <div class="profile__item">
        <a class="profile__item--edit" href="/mypage/profile">プロフィールを編集</a>
    </div>
</div>
<div class="tab_wrap">
    <input id="tab1" type="radio" name="tab_btn" checked>
    <input id="tab2" type="radio" name="tab_btn">

    <div class="tab_area">
        <label class="tab1_label" for="tab1">出品した商品</label>
        <label class="tab2_label" for="tab2">購入した商品</label>
        <label class="tab3_label" for="tab3">
            取引中の商品<span class="number">2</span>
        </label>
    </div>
    <div class="panel_area">
        <div id="panel1" class="product__list">
            @foreach ($listings as $product)
            <div class="product__item">
                <a class="product__link" href="/item/{{ $product['id'] }}">
                    <div class="product__img">
                        <img class="img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product__name">
                        {{ $product['name'] }}
                    </div>
                    @if ($product->orders->isNotEmpty())
                    <div class="product__sold">
                        SOLD
                    </div>
                    @endif
                </a>
            </div>
            @endforeach
        </div>
        <div id="panel2" class="product__list">
            @foreach ($orders as $product)
            <div class="product__item">
                <a class="product__link" href="/item/{{ $product['id'] }}">
                    <div class="product__img">
                        <img class="img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product__name">
                        {{ $product['name'] }}
                    </div>
                    <div class="product__sold">
                        SOLD
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div id="panel3" class="product__list">
            @foreach ($orders as $product)
            <div class="product__item">
                <a class="product__link" href="/item/{{ $product['id'] }}">
                    <div class="product__img">
                        <img class="img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product__name">
                        {{ $product['name'] }}
                    </div>
                    <div class="product__sold">
                        SOLD
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection