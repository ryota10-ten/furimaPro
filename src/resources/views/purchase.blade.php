@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="content__purchase">
    <div class="purchase__info">
        <div class="item__info">
            <div class="item__info--img">
                <img class="item__img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
            </div>
            <div class="item__info--detail">
                <p class="item__name">
                    {{ $product['name'] }}
                </p>
                <p class="item__price">
                    <span>
                        &yen;
                    </span>
                    {{ number_format($product['price']) }}
                </p>
            </div>
        </div>
        <div class="purchase__method">
            <h3 class="purchase__method--header">
                支払い方法
            </h3>
            <form method="POST" action="/purchase/method/{{ $product['id'] }}">
            @csrf
                <select class="purchase__method--select" name="method" onchange="this.form.submit()">
                    <option value="" {{ $selectedMethod == '' ? 'selected' : '' }}>
                        選択してください
                    </option>
                    <option value="コンビニ払い" {{ $selectedMethod == 'コンビニ払い' ? 'selected' : '' }}>
                        コンビニ払い
                    </option>
                    <option value="カード払い" {{ $selectedMethod == 'カード払い' ? 'selected' : '' }}>
                        カード払い
                    </option>
                </select>
            </form>
        </div>
        <div class="purchase__address">
            <div class="address__navi">
                <h3 class="address__header">
                    配送先
                </h3>
                <p class="address__edit">
                    <a href="/purchase/address/{{ $product['id'] }}">変更する</a>
                </p>
            </div>
            <div class="address__info">
                @if(empty($address))
                    〒{{ $user['post'] }}<br>
                    {{ $user['address'] }}{{ $user['building'] }}
                @else
                    〒{{ $address['post'] }}<br>
                    {{ $address['address'] }}{{ $address['building'] }}
                @endif
            </div>
        </div>
    </div>
    <div class="purchase__form">
        <form class="form" action="{{ route('purchase.fix', ['id' => $product->id]) }}" method="post" >
        @csrf
            <table class="form__table">
                <tr class="form__table--row">
                    <th class="form__table--header">
                        商品代金
                    </th>
                    <td class="form__table--item">
                        <span class="price__font">&yen;</span>{{ number_format($product['price']) }}
                    </td>
                </tr>
                <tr class="form__table--row">
                    <th class="form__table--header">
                        支払い方法
                    </th>
                    <td class="form__table--item">
                        <input type="text" name="method" value="{{ $selectedMethod ?? '選択してください' }}" readonly/>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            @if(is_null($address))
            <input type="hidden" name="post" value="{{ $user['post'] }}">
            <input type="hidden" name="address" value="{{ $user['address'] }}">
            <input type="hidden" name="building" value="{{ $user['building'] }}">
            @else
            <input type="hidden" name="post" value="{{ $address['post'] }}">
            <input type="hidden" name="address" value="{{ $address['address'] }}">
            <input type="hidden" name="building" value="{{ $address['building'] }}">
            @endif
            <div class="form__error">
                @error('method')
                {{ $message }}
                @enderror
            </div>
            <button class="button__purchase" type="submit">
                購入する
            </button>
            <div class="form__error">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection