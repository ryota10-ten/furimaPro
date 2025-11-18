@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="tab_wrap">
    <input id="tab1" type="radio" name="tab_btn" {{ ($tab ?? 'tab1') === 'tab1' ? 'checked' : '' }}>
    <input id="tab2" type="radio" name="tab_btn" {{ ($tab ?? 'tab1') === 'tab2' ? 'checked' : '' }}>

    <div class="tab_area">
        <label class="tab1_label" for="tab1">おすすめ</label>
        <label class="tab2_label" for="tab2">マイリスト</label>
    </div>
    <div class="panel_area">
        <div id="panel1" class="product__list">
            @foreach ($products as $product)
            <div class="product__item">
                <a class="product__link" href="/item/{{ $product['id'] }}">
                    <div class="product__img">
                        <img class="img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product__name">
                    {{ $product['name'] }}
                    @if ($product->orders->isNotEmpty())
                    <div class="product__sold">SOLD</div>
                    @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div id="panel2" class="product__list">
            @if (Auth::check())
                @foreach ($favorites as $product)
                <div class="product__item">
                    <a class="product__link" href="/item/{{ $product['id'] }}">
                        <div class="product__img">
                            <img class="img" src="{{ asset('storage/' . $product['img']) }}" alt="{{ $product['name'] }}">
                        </div>
                        <div class="product__name">
                        {{ $product['name'] }}
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                <p>ログインしてください</p>
            @endif
        </div>
    </div>
</div>
<script>
    const tab1 = document.getElementById('tab1');
    const tab2 = document.getElementById('tab2');
    const searchTab = document.getElementById('search_tab');

    tab1.addEventListener('change', () => { searchTab.value = 'tab1'; });
    tab2.addEventListener('change', () => { searchTab.value = 'tab2'; });
</script>
@endsection
