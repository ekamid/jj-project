<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "published",
        "parent_id",
        "description",
        "banner",
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
