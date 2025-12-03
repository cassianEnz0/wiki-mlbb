<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Item;
use App\Models\Position;
use App\Models\Hero;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin (Pakai firstOrCreate biar aman kalau di-seed ulang)
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Ganteng',
                'password' => Hash::make('password'),
            ]
        );

        echo "✅ Admin Siap: admin@gmail.com | password\n";

        // 2. ROLES
        $rolesData = [
            ['name' => 'Tank',      'image' => 'images/roles/tank.png'],
            ['name' => 'Fighter',   'image' => 'images/roles/fighter.png'],
            ['name' => 'Assassin',  'image' => 'images/roles/assasins.png'],
            ['name' => 'Mage',      'image' => 'images/roles/mage.png'],
            ['name' => 'Marksman',  'image' => 'images/roles/marksman.png'],
            ['name' => 'Support',   'image' => 'images/roles/support.png'],
        ];

        // Tampung hasilnya ke variabel biar bisa dipake buat Hero nanti
        $roleCollection = collect(); 

        foreach ($rolesData as $r) { 
            $role = Role::firstOrCreate($r); 
            $roleCollection->push($role);
        }

        // 3. POSITIONS
        $positionsData = [
            ['name' => 'Roam',      'image' => 'images/positions/roam.png'],
            ['name' => 'Mid Lane',  'image' => 'images/positions/mid.png'],
            ['name' => 'Gold Lane', 'image' => 'images/positions/gold.png'],
            ['name' => 'Exp Lane',  'image' => 'images/positions/exp.png'],
            ['name' => 'Jungler',   'image' => 'images/positions/jungle.png'],
        ];

        $positionCollection = collect();

        foreach ($positionsData as $p) { 
            $pos = Position::firstOrCreate($p);
            $positionCollection->push($pos);
        }

        echo "✅ Role & Position (dengan Gambar) Siap\n";

        // 4. ITEMS
        // --- ATTACK ITEMS ---
        $attackItems = [
            ['name' => "Berserker's Fury",       'image' => "images/items/attack/berserker's-fury.png"],
            ['name' => "Blade of Despair",       'image' => "images/items/attack/blade-of-the-despair.png"],
            ['name' => "Blade of the Heptaseas", 'image' => "images/items/attack/blade-of-the-heptaseas.png"],
            ['name' => "Bloodlust Axe",          'image' => "images/items/attack/bloodlust-axe.png"],
            ['name' => "Corrosion Scythe",       'image' => "images/items/attack/corrosion-scythe.png"],
            ['name' => "Demon Hunter Sword",     'image' => "images/items/attack/demon-hunter-sword.png"],
            ['name' => "Endless Battle",         'image' => "images/items/attack/endless-battle.png"],
            ['name' => "Golden Staff",           'image' => "images/items/attack/golden-staff.png"],
            ['name' => "Haas's Claws",           'image' => "images/items/attack/haas's-claws.png"],
            ['name' => "Hunter Strike",          'image' => "images/items/attack/hunter-strike.png"],
            ['name' => "Malefic Roar",           'image' => "images/items/attack/malefic-roar.png"],
            ['name' => "Rose Gold Meteor",       'image' => "images/items/attack/rose-gold-meteor.png"],
            ['name' => "Scarlet Phantom",        'image' => "images/items/attack/scarlet-phantom.png"],
            ['name' => "Sea Halberd",            'image' => "images/items/attack/sea-halberd.png"],
            ['name' => "War Axe",                'image' => "images/items/attack/war-axe.png"],
            ['name' => "Wind of Nature",         'image' => "images/items/attack/wind-of-nature.png"],
            ['name' => "Windtalker",             'image' => "images/items/attack/windtalker.png"],
        ];
        foreach ($attackItems as $i) { Item::firstOrCreate(['name' => $i['name']], ['category' => 'Attack', 'image' => $i['image']]); }

        // --- DEFENSE ITEMS ---
        $defenseItems = [
            ['name' => "Antique Cuirass",        'image' => "images/items/defense/antique-cuirass.png"],
            ['name' => "Athena's Shield",        'image' => "images/items/defense/athena's-shield.png"],
            ['name' => "Blade Armor",            'image' => "images/items/defense/blade-armor.png"],
            ['name' => "Brute Force Breastplate",'image' => "images/items/defense/brute-force-breastplate.png"],
            ['name' => "Cursed Helmet",          'image' => "images/items/defense/cursed-helmet.png"],
            ['name' => "Dominance Ice",          'image' => "images/items/defense/dominance-ice.png"],
            ['name' => "Guardian Helmet",        'image' => "images/items/defense/guardian-helmet.png"],
            ['name' => "Immortality",            'image' => "images/items/defense/immortality.png"],
            ['name' => "Oracle",                 'image' => "images/items/defense/oracle.png"],
            ['name' => "Queen's Wings",          'image' => "images/items/defense/queen's-wings.png"],
            ['name' => "Radiant Armor",          'image' => "images/items/defense/radiant-armor.png"],
            ['name' => "Thunder Belt",           'image' => "images/items/defense/thunder-belt.png"],
            ['name' => "Twilight Armor",         'image' => "images/items/defense/twilight-armor.png"],
        ];
        foreach ($defenseItems as $i) { Item::firstOrCreate(['name' => $i['name']], ['category' => 'Defense', 'image' => $i['image']]); }

        // --- MAGIC ITEMS ---
        $magicItems = [
            ['name' => "Blood Wings",            'image' => "images/items/magic/blood-wings.png"],
            ['name' => "Calamity Reaper",        'image' => "images/items/magic/calamity-reaper.png"],
            ['name' => "Clock of Destiny",       'image' => "images/items/magic/clock-of-destiny.png"],
            ['name' => "Concentrated Energy",    'image' => "images/items/magic/concentrated-energy.png"],
            ['name' => "Divine Glaive",          'image' => "images/items/magic/divine-glaive.png"],
            ['name' => "Enchanted Talisman",     'image' => "images/items/magic/enchanted-talisman.png"],
            ['name' => "Feather of Heaven",      'image' => "images/items/magic/feather-of-heaven.png"],
            ['name' => "Fleeting Time",          'image' => "images/items/magic/fleeting-time.png"],
            ['name' => "Genius Wand",            'image' => "images/items/magic/genius-wand.png"],
            ['name' => "Glowing Wand",           'image' => "images/items/magic/glowing-wand.png"],
            ['name' => "Holy Crystal",           'image' => "images/items/magic/holy-crystal.png"],
            ['name' => "Ice Queen Wand",         'image' => "images/items/magic/ice-queen-wand.png"],
            ['name' => "Lightning Truncheon",    'image' => "images/items/magic/lightning-truncheon.png"],
            ['name' => "Necklace of Durance",    'image' => "images/items/magic/necklace-of-durance.png"],
            ['name' => "Winter Truncheon",       'image' => "images/items/magic/winter-truncheon.png"],
        ];
        foreach ($magicItems as $i) { Item::firstOrCreate(['name' => $i['name']], ['category' => 'Magic', 'image' => $i['image']]); }

        // --- MOVEMENT ITEMS ---
        $movementItems = [
            ['name' => "Arcane Boots",           'image' => "images/items/movement/arcane-boots.png"],
            ['name' => "Demon Shoes",            'image' => "images/items/movement/demon-shoes.png"],
            ['name' => "Magic Shoes",            'image' => "images/items/movement/magic-shoes.png"],
            ['name' => "Rapid Boots",            'image' => "images/items/movement/rapid-boots.png"],
            ['name' => "Swift Boots",            'image' => "images/items/movement/swift-boots.png"],
            ['name' => "Tough Boots",            'image' => "images/items/movement/tough-boots.png"],
            ['name' => "Warrior Boots",          'image' => "images/items/movement/warrior-boots.png"],
        ];
        foreach ($movementItems as $i) { Item::firstOrCreate(['name' => $i['name']], ['category' => 'Movement', 'image' => $i['image']]); }
        

    }
}
