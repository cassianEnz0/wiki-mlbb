<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image'];

    public function heroes() {
        return $this->belongsToMany(Hero::class, 'hero_role');
    }
}