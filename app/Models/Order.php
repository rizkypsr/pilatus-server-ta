<?php

namespace App\Models;

use App\Http\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use UUID;
    use HasFactory;

    protected $table = 'order';

    protected $guarded = [];

    public function user()
    {
        return  $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return  $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function shipping()
    {
        return $this->belongsTo(Shipping::class);
    }
}
