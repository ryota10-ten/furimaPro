<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoachTech</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    @yield('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="/">
                    <img class="header__logo--img" src="{{asset('img/logo.svg')}}" alt="CoachTech">
                </a>
            </div>
            <form class="header__search" method="get" action="/search">
            @csrf
                <input class="header__search--item" type="text" name="keyword" placeholder="なにをお探しですか？">
                <input type="hidden" name="tab" id="search_tab" value="{{ $tab ?? 'tab1' }}">
            </form>
            <div class="header__buttons">
                @if (Auth::check())
                <form method="POST" action="/logout">
                @csrf
                    <button class="header__button--logout" type="submit">ログアウト</button>
                </form>
                @else
                <a class="header__button--login" href="/login">ログイン</a>
                @endif
                <a class="header__button--mypage" href="/mypage">マイページ</a>
                <a class="header__button--sell" href="/sell">出品</a>
            </div>
        </div>
    </header>
    <main class="content">
    @yield('content')
    </main>
</body>
</html>