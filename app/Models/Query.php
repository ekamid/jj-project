<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'created_by',
        'type',
        'order_code',
        'description',
        'reply_to',
        'answered',
    ];
}
