<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;
    
    // Kolom apa aja yang boleh diisi user
    protected $fillable = ['name', 'slug', 'photo', 'story', 'user_id'];

    // Relasi: Hero dibuat oleh satu User
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi: Hero punya banyak Role
    public function roles() {
        return $this->belongsToMany(Role::class, 'hero_role');
    }

    // Relasi: Hero punya banyak Item
    public function items() {
        return $this->belongsToMany(Item::class, 'hero_item');
    }

    // Relasi: Hero punya banyak Position
    public function positions() {
        return $this->belongsToMany(Position::class, 'hero_position');
    }
}