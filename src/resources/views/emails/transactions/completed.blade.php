@component('mail::message')
# 取引完了のお知らせ

{{ $transaction->buyer->name }} さんとの取引が完了しました。

**商品名:** {{ $transaction->product->name }}  
**取引金額:** ¥{{ number_format($transaction->product->price) }}


@component('mail::button', ['url' => url('/transactions/'.$transaction->id)])
取引詳細を見る
@endcomponent

今後ともよろしくお願いいたします。

@endcomponent
