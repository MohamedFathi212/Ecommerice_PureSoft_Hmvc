<?php

namespace App\Models;
use App\Models\OrderItem;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'total',
        'status',
        'payment_method',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
