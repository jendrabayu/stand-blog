<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable  = ['title', 'slug'];

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'category_id', 'id');
    }

    public static function getLatestId()
    {
        return intval(self::orderByDesc('id')->first()->id ?? 0);
    }
}
