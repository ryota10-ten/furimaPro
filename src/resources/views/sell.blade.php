@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<h1 class="content__title">商品の出品</h1>
<div class="form">
    <form class="form__sell" action="/sell" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form__sell--item">
            <h3 class="form__item--title">商品画像</h3>
            <div class="form__update--preview" id="img-preview">
                <label class="form__update--item" for="img">
                    画像を選択する
                </label>
            </div>
            <input class="form__update--img" type="file" id="img" name="img" accept=".jpeg, .png, .jpg" >
            <div class="form__error">
                @error('img')
                {{ $message }}
                @enderror
            </div>
        </div>
        <h2 class="form__sell--title">商品の説明</h2>
        <div class="form__sell---item">
            <h3 class="form__item--title">カテゴリー</h3>
            <div class="form__category">
            @foreach ($categories as $category)
                <input class="form__category--item" type="checkbox" name="category[]" id="category-{{ $category['id'] }}" value="{{ $category['id'] }}">
                <label class="category__label" for="category-{{ $category['id'] }}">
                {{ $category['category'] }}
                </label>
            @endforeach
            </div>
            <div class="form__error">
                @error('category')
                {{ $message }}
                @enderror
            </div>
            <h3 class="form__item--title">商品の状態</h3>
            <div class="form__condition">
                <select class="form__condition--item" name="condition_id">
                    <option value="" selected>選択してください</option>
                    @foreach ($conditions as $condition)
                    <option value="{{ $condition['id'] }}">
                        <label class="condition__label" for="condition-{{ $condition['id'] }}">
                        {{ $condition['condition'] }}
                        </label>
                    </option>
                @endforeach
                </select>
                <div class="form__error">
                @error('condition_id')
                {{ $message }}
                @enderror
                </div>
            </div>
        </div>
        <h2 class="form__sell--title">商品名と説明</h2>
        <div class="form__sell---item">
            <h3 class="form__item--title">商品名</h3>
            <input class="form__item" type="text" name="name" value="{{ old('name') }}">
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <h3 class="form__item--title">ブランド名</h3>
            <input class="form__item" type="text" name="brand" value="{{ old('brand') }}">
            <div class="form__error">
                @error('brand')
                {{ $message }}
                @enderror
            </div>
            <h3 class="form__item--title">商品の説明</h3>
            <textarea class="form__item" name="detail" rows="10" value="{{ old('detail') }}"></textarea>
            <div class="form__error">
                @error('detail')
                {{ $message }}
                @enderror
            </div>
            <h3 class="form__item--title">販売価格</h3>
            <input class="form__item" type="text" name="price" value="&yen;">
            <div class="form__error">
                @error('price')
                {{ $message }}
                @enderror
            </div>
        </div>
        <button class="form__button" type="submit">
            出品する
        </button>
    </form>
</div>
<script>
    const fileInput = document.getElementById('img');
    const imagePreview = document.getElementById('img-preview');

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        imagePreview.innerHTML = '';
        imagePreview.style.backgroundColor = '#D9D9D9';

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                imagePreview.appendChild(img);
                imagePreview.style.backgroundColor = 'transparent';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection