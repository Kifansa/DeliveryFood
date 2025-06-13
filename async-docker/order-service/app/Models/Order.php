<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'menu_item_id',
        'quantity',
        'status',
    ];
}
