@extends('layouts.header')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<h1 class="content__title">住所の変更</h1>
<div class="content__form">
    <form class="form__update" action="/purchase/address/{{ $product['id'] }}" method="POST" >
    @csrf
        <input class="form__update--item" type="hidden" name="name" value="{{ $user['name'] }}" >
        <label class="form__update--label">郵便番号</label>
        <input class="form__update--item" type="text" name="post" value="{{  old('post', $user['post']) }}">
        <div class="form__error">
            @error('post')
            {{ $message }}
            @enderror
        </div>
        <label class="form__update--label">住所</label>
        <input class="form__update--item" type="text" name="address" value="{{  old('address', $user['address']) }}">
        <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
        </div>
        <label class="form__update--label">建物名</label>
        <input class="form__update--item" type="text" name="building" value="{{  old('building', $user['building']) }}">
        <div class="form__error">
            @error('building')
            {{ $message }}
            @enderror
        </div>
        <button class="form__update--button" type="submit">更新する</button>
    </form>
<div>
@endsection