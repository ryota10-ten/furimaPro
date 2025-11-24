<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoachTech</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/transaction.css')}}">
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
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
                @foreach ($otherTransactions as $t)
                    <div class="product__name">
                        <a href="/transaction/{{ $t->id }}">
                            {{ $t->product->name }}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="transaction__content">
                <div class="transaction__header">
                    <div class="profile__item">
                        @if ($partner->icon)
                            <img src="{{ asset('storage/' . $partner->icon) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="{{ asset('img/default-icon.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                        @endif
                        <div class="profile__item--profile">
                            {{ $partner->name }}さんとの取引画面
                        </div>
                    </div>
                    @php
                        $userId = Auth::id();
                    @endphp
                    @if ($transaction->buyer_id == $userId && $transaction->status == \App\Models\Transaction::STATUS_PENDING)
                        <form action="{{ route('transaction.complete', $transaction->id) }}" method="POST" class="fix__button">
                            @csrf
                            <button type="submit">
                                取引を完了する
                            </button>
                        </form>
                    @elseif ($transaction->buyer_id == $userId && $transaction->status == \App\Models\Transaction::STATUS_COMPLETED)
                        <div class="fix__button--completed">
                            取引完了済み
                        </div>
                    @endif
                </div>
                <div class="product__item">
                    <div class="product__img">
                        <img class="img__size" src="{{ asset('storage/' . $transaction->product->img) }}"  alt="{{ $transaction->product->name}}" >
                    </div>
                    <div class="product__detail">
                        <p class="product__detail--name">
                            {{ $transaction->product->name}}
                        </p>
                        <p class="product__detail--price">
                            {{ $transaction->product->price}}円（税込）
                        </p>
                    </div>
                </div>
                <div class="chat__space">
                    <div class="messages">
                        @foreach ($messages as $msg)
                            @php
                                $isMine = $msg->sender_id === Auth::id();
                            @endphp
                            @if (! $isMine)
                                <div class="reception__message">
                                    <div class="reception__detail">
                                        <div class="user__icon">
                                            @if ($partner->icon)
                                                <img src="{{ asset('storage/' . $partner->icon) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('img/default-icon.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @endif
                                        </div>
                                        <div class="reception__name">
                                            {{ $partner->name }}
                                        </div>
                                    </div>
                                    <div class="message">
                                        <span class="message__detail">{{ $msg->message }}</span>
                                    </div>
                                    @if ($msg->image_path)
                                        <div class="message__img">
                                            <img src="{{ asset('storage/' . $msg->image_path) }}" alt="送信画像">
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if ($isMine)
                                <div class="send__message">
                                    <div class="send__detail">
                                        <div class="send__name">
                                            {{ Auth::user()->name }}
                                        </div>
                                        <div class="user__icon">
                                            @if(Auth::user()->icon)
                                                <img src="{{ asset('storage/' .Auth::user()->icon) }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <img src="{{ asset('img/default-icon.png') }}" style="width: 50px; height: 50px; border-radius: 50%;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="message">
                                        <span class="message__detail">{{ $msg->message }}</span>
                                    </div>
                                    @if ($msg->image_path)
                                        <div class="message__img">
                                            <img src="{{ asset('storage/' . $msg->image_path) }}" alt="送信画像">
                                        </div>
                                    @endif
                                    <div class="message__edit">
                                        <div class="message__edit--edit" onclick="toggleEditForm({{ $msg->id }})">
                                            編集
                                        </div>
                                        <form action="{{ route('transaction.message.delete', $msg->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="message__edit--delete">
                                                削除
                                            </button>
                                        </form>
                                    </div>
                                    <div class="edit__form" id="edit__form__{{ $msg->id }}">
                                        <form action="{{ route('transaction.message.update', $msg->id) }}" method="POST" enctype="multipart/form-data" class="edit__form--message">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="message" rows="2" style="width:100%;">{{ $msg->message }}</textarea>
                                            <button type="submit" class="update__btn">
                                                更新
                                            </button>
                                            <button type="button" onclick="toggleEditForm({{ $msg->id }})">
                                                キャンセル
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if ($errors->any())
                        <div class="form__errors">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="imagePreview" class="image__pre"></div>
                    <form action="{{ route('transaction.message.send', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="message__form">
                        @csrf
                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                        <input class="send__text" type="text" name="message" id="messageInput" placeholder="取引メッセージを記入してください" value="{{ old('message') }}">
                        <div class="send__img">
                            <label for="imageInput">
                                画像を追加
                            </label>
                            <input type="file" name="image" id="imageInput" accept="image/*">
                        </div>
                        <button type="submit" class="send__icon">
                            <img src="{{ asset('img/inputbutton.png') }}" >
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @if ($showReviewModal)
            @include('review')
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.toggleEditForm = function(id) {
                    const form = document.getElementById(`edit__form__${id}`);
                    if (!form) return;
                    form.style.display = (form.style.display === "none") ? "block" : "none";
                }
                const messageInput = document.getElementById('messageInput');
                const storageKey = 'transaction_message_{{ $transaction->id }}';
                if (messageInput) {
                    const savedMessage = localStorage.getItem(storageKey);
                    if (savedMessage) {
                        messageInput.value = savedMessage;
                    }
                    messageInput.addEventListener('input', () => {
                        localStorage.setItem(storageKey, messageInput.value);
                    });
                    const messageForm = document.querySelector('.message__form');
                    if (messageForm) {
                        messageForm.addEventListener('submit', () => {
                            localStorage.removeItem(storageKey);
                        });
                    }
                }
                const imageInput = document.getElementById('imageInput');
                const previewContainer = document.getElementById('imagePreview');
                if (imageInput && previewContainer) {
                    imageInput.addEventListener('change', (e) => {
                        previewContainer.innerHTML = "";
                        const file = e.target.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const imgWrapper = document.createElement('div');
                            imgWrapper.style.position = 'relative';
                            imgWrapper.style.display = 'inline-block';
                            imgWrapper.style.marginRight = '5px';

                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.style.maxWidth = '150px';
                            img.style.maxHeight = '150px';
                            img.style.borderRadius = '4px';
                            imgWrapper.appendChild(img);

                            const deleteBtn = document.createElement('button');
                            deleteBtn.textContent = '✕';
                            deleteBtn.style.position = 'absolute';
                            deleteBtn.style.top = '2px';
                            deleteBtn.style.right = '2px';
                            deleteBtn.style.background = 'rgba(0,0,0,0.5)';
                            deleteBtn.style.color = 'white';
                            deleteBtn.style.border = 'none';
                            deleteBtn.style.borderRadius = '50%';
                            deleteBtn.style.width = '20px';
                            deleteBtn.style.height = '20px';
                            deleteBtn.style.cursor = 'pointer';
                            deleteBtn.addEventListener('click', () => {
                                imgWrapper.remove();
                                imageInput.value = "";
                            });

                            imgWrapper.appendChild(deleteBtn);
                            previewContainer.appendChild(imgWrapper);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        </script>
    </main>
</body>
</html>