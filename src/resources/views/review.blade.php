<div class="modal__overlay--active">
    <div class="modal__content">
        <div class="fin__message">
            取引が完了しました。
        </div>
        <span class="span__message">今回の取引相手はどうでしたか？</span>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
            <input type="hidden" name="reviewee_id" value="{{ $partner->id }}">
            <input type="hidden" name="rating" id="ratingValue">
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <div class="review__button">
                <button type="submit">
                    送信する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("ratingValue");

        stars.forEach(star => {
            star.addEventListener("click", () => {
                const value = star.getAttribute("data-value");
                ratingInput.value = value;

                stars.forEach(s => {
                    s.classList.remove("selected");
                    if (s.getAttribute("data-value") <= value) {
                        s.classList.add("selected");
                    }
                });
            });
        });
    });

    function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
    }
</script>