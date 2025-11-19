<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoachTech</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/transaction.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">

</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="/">
                <img class="header__logo--img" src="{{asset('img/logo.svg')}}" alt="CoachTech">
            </a>
        </div>
    </header>
    <main class="content">
        <div class="transaction">
            <div class="menu">
                <p class="menu__header">その他の取引</p>
                <div class="product__name">
                    商品名
                </div>
            </div>
            <div class="transaction__content">
                <div class="transaction__header">
                    <div class="profile__item">
                        <div class="profile__item--icon">
                            <img src="{{ asset('img/default-icon.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                        </div>
                        <div class="profile__item--profile">
                            「ユーザー名」さんとの取引画面
                        </div>
                    </div>
                    <div class="fix__button">
                        取引を完了する
                    </div>
                </div>
                <div class="product__item">
                    <div class="product__img">
                        <img src="{{ asset('img/default-icon.png') }}" style="width: 100px; height: 100px;">
                    </div>
                    <div class="product__detail">
                        <p class="product__detail--name">
                            商品名
                        </p>
                        <p class="product__detail--price">
                            商品価格
                        </p>
                    </div>
                </div>
                <div class="chat__space">
                    <div class="messages">
                        <div class="reception__message">
                            <div class="reception__detail">
                                <div class="user__icon">
                                    <img src="{{ asset('img/default-icon.png') }}" style="width: 30px; height: 30px; border-radius: 50%;">
                                </div>
                                <div class="reception__name">
                                    ユーザー名
                                </div>
                            </div>
                            <div class="message">
                                <span class=message__detail>テスト</span>
                            </div>
                        </div>
                        <div class="send__message">
                            <div class="send__detail">
                                <div class="send__name">
                                    ユーザー名
                                </div>
                                <div class="user__icon">
                                    <img src="{{ asset('img/default-icon.png') }}" style="width: 30px; height: 30px; border-radius: 50%;">
                                </div>
                            </div>
                            <div class="message">
                                テスト
                            </div>
                            <div class="message__edit">
                                <div class="message__edit--edit">
                                    編集
                                </div>
                                <div class="message__edit--delete">
                                    削除
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="message__form">
                        <div class="send__text">
                            <span class="text">取引メッセージを記入してください</span>
                        </div>
                        <div class="send__img">
                            画像を追加
                        </div>
                        <div class="send__icon">
                            <img src="{{ asset('img/inputbutton.png') }}" style="width: 40px; height: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>