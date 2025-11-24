<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;

    protected $fillable = [
        'order_id',
        'product_id',
        'seller_id',
        'buyer_id',
        'status',
        'last_message_at',
    ];

    public function scopeRelatedToUser($query, $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('seller_id', $userId)
              ->orWhere('buyer_id', $userId);
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function messages()
    {
        return $this->hasMany(TransactionMessage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function unreadMessageCount($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('read', false)
            ->count();
    }
}
