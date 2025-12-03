<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    // 1. TAMPILKAN LIST HERO + SEARCH + FILTER + PAGINATION
    public function index()
    {
        // Start Query with Eager Loading
        $heroes = Hero::with(['roles', 'positions'])->latest();

        // Filter: Search Name
        if (request('search')) {
            $heroes->where('name', 'like', '%' . request('search') . '%');
        }

        // Filter: Role (e.g. Mage)
        if (request('role')) {
            $heroes->whereHas('roles', function($query) {
                $query->where('name', request('role'));
            });
        }

        // Filter: Lane (e.g. Mid Lane)
        if (request('lane')) {
            $heroes->whereHas('positions', function($query) {
                $query->where('name', 'like', '%' . request('lane') . '%');
            });
        }

        // Get Data (10 per page) and keep filters in URL (appends)
        $heroes = $heroes->paginate(10)->appends(request()->all());

        return view('dashboard', compact('heroes'));
    }

    // 2. FORM CREATE
    public function create()
    {
        $roles = Role::all();
        // UPDATE: Grouping by category
        $items = Item::all()->groupBy('category');
        $positions = \App\Models\Position::all(); 
        return view('heroes.create', compact('roles', 'items', 'positions'));
    }

    // 3. STORE NEW HERO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|max:2048',
            'story' => 'required',
            'roles' => 'required|array',
            'positions' => 'required|array',
            'items' => 'required|array|max:6',
        ]);

        $photoPath = $request->file('photo')->store('heroes', 'public');

        $hero = Hero::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'photo' => $photoPath,
            'story' => $request->story,
            'user_id' => auth()->id(),
        ]);

        $hero->roles()->attach($request->roles);
        $hero->items()->attach($request->items);
        $hero->positions()->attach($request->positions);

        return redirect()->route('dashboard')->with('success', 'Hero sukses dibuat!');
    }

    // 4. SHOW DETAIL
    public function show(Hero $hero)
    {
        $hero->load(['roles', 'items', 'positions', 'author']);
        return view('heroes.show', compact('hero'));
    }

    // 5. EDIT FORM
    public function edit(Hero $hero)
    {
        $roles = Role::all();
        // UPDATE: Grouping by category
        $items = Item::all()->groupBy('category');
        $positions = \App\Models\Position::all();
        return view('heroes.edit', compact('hero', 'roles', 'items', 'positions'));
    }

    // 6. UPDATE HERO
    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'story' => 'required',
            'roles' => 'required|array',
            'positions' => 'required|array',
            'items' => 'required|array|max:6',
        ]);

        if ($request->hasFile('photo')) {
            if ($hero->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($hero->photo);
            }
            $photoPath = $request->file('photo')->store('heroes', 'public');
        } else {
            $photoPath = $hero->photo;
        }

        $hero->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'photo' => $photoPath,
            'story' => $request->story,
        ]);

        $hero->roles()->sync($request->roles);
        $hero->items()->sync($request->items);
        $hero->positions()->sync($request->positions);

        return redirect()->route('dashboard')->with('success', 'Hero berhasil diupdate!');
    }

    // 7. DELETE HERO
    public function destroy(Hero $hero)
    {
        if ($hero->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($hero->photo);
        }
        $hero->delete();
        return redirect()->route('dashboard')->with('success', 'Hero telah dihapus!');
    }
}