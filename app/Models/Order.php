<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = ['user_id', 'metode_pembayaran', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
