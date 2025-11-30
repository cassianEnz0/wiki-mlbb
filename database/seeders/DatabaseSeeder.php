<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Item;
use App\Models\Position;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // 2. ROLES
        // Nanti lu harus siapin gambar di public/images/roles/nama_file.png
        $roles = [
            ['name' => 'Tank', 'image' => 'images/roles/tank.png'],
            ['name' => 'Fighter', 'image' => 'images/roles/fighter.png'],
            ['name' => 'Assassin', 'image' => 'images/roles/assassin.png'],
            ['name' => 'Mage', 'image' => 'images/roles/mage.png'],
            ['name' => 'Marksman', 'image' => 'images/roles/mm.png'],
            ['name' => 'Support', 'image' => 'images/roles/support.png'],
        ];
        foreach ($roles as $r) { Role::create($r); }

        // 3. POSITIONS
        // Nanti lu harus siapin gambar di public/images/positions/nama_file.png
        $positions = [
            ['name' => 'Gold Lane', 'image' => 'images/positions/gold.png'],
            ['name' => 'Exp Lane', 'image' => 'images/positions/exp.png'],
            ['name' => 'Mid Lane', 'image' => 'images/positions/mid.png'],
            ['name' => 'Roamer', 'image' => 'images/positions/roam.png'],
            ['name' => 'Jungler', 'image' => 'images/positions/jungle.png'],
        ];
        foreach ($positions as $p) { Position::create($p); }

        // 4. ITEMS (Contoh aja, nanti tambah lagi sesuai banyaknya item)
        // Nanti lu harus siapin gambar di public/images/items/'jenis itemnya'/nama_file.png
        Item::create(['name' => 'Blade of Despair', 'category' => 'attack', 'image' => 'images/items/attack/bod.png']);
        Item::create(['name' => 'Holy Crystal', 'category' => 'magic', 'image' => 'images/items/holy.png']);
        Item::create(['name' => 'Athena Shield', 'category' => 'defense', 'image' => 'images/items/athena.png']);
        Item::create(['name' => 'Warrior Boots', 'category' => 'movement', 'image' => 'images/items/warrior.png']);
    }
}