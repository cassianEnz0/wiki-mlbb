<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'image'];

    public function heroes() {
        return $this->belongsToMany(Hero::class, 'hero_item');
    }
}