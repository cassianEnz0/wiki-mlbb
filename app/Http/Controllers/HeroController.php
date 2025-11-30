<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    // 1. TAMPILKAN LIST HERO + SEARCH + PAGINATION
    public function index()
    {
        // Mulai Query
        $heroes = Hero::with('roles')->latest();

        // Kalau ada yang nyari (ketik di search bar)
        if (request('search')) {
            $heroes->where('name', 'like', '%' . request('search') . '%');
        }

        // Ambil datanya, tapi potong jadi 10 hero per halaman
        // paginate(10) artinya 1 halaman cuma muat 10 hero
        $heroes = $heroes->paginate(10); 

        return view('dashboard', compact('heroes'));
    }

    // 2. TAMPILKAN FORM TAMBAH HERO (Updated)
    public function create()
    {
        $roles = Role::all();
        $items = Item::all();
        $positions = \App\Models\Position::all(); // <-- Kita ambil data Posisi
        return view('heroes.create', compact('roles', 'items', 'positions'));
    }

    // 3. PROSES SIMPAN DATA (Updated)
    public function store(Request $request)
    {
        // A. Validasi (Tambah positions)
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|max:2048',
            'story' => 'required',
            'roles' => 'required|array',
            'positions' => 'required|array', // <-- Validasi Posisi
            'items' => 'required|array|max:6',
        ]);

        // B. Upload Gambar Hero
        $photoPath = $request->file('photo')->store('heroes', 'public');

        // C. Simpan Hero
        $hero = Hero::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'photo' => $photoPath,
            'story' => $request->story,
            'user_id' => auth()->id(),
        ]);

        // D. Sambungin Relasi (Roles, Items, dan Positions)
        $hero->roles()->attach($request->roles);
        $hero->items()->attach($request->items);
        $hero->positions()->attach($request->positions); // <-- Simpan Posisi

        return redirect()->route('dashboard')->with('success', 'Hero sukses dibuat!');
    }

    // 4. TAMPILKAN DETAIL HERO (Halaman Baca)
    public function show(Hero $hero)
    {
        // Ambil data hero beserta relasinya (roles, items, positions)
        // Biar database gak kerja dua kali (Eager Loading)
        $hero->load(['roles', 'items', 'positions', 'author']);
        
        return view('heroes.show', compact('hero'));
    }

    // 5. TAMPILKAN FORM EDIT
    public function edit(Hero $hero)
    {
        $roles = Role::all();
        $items = Item::all();
        $positions = \App\Models\Position::all();
        
        return view('heroes.edit', compact('hero', 'roles', 'items', 'positions'));
    }

    // 6. PROSES UPDATE DATA
    public function update(Request $request, Hero $hero)
    {
        // Validasi (Foto jadi nullable/boleh kosong, karena kalau gak mau ganti foto ya gapapa)
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048', // Boleh kosong
            'story' => 'required',
            'roles' => 'required|array',
            'positions' => 'required|array',
            'items' => 'required|array|max:6',
        ]);

        // Logic Update Foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama biar server gak penuh
            if ($hero->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($hero->photo);
            }
            // Upload foto baru
            $photoPath = $request->file('photo')->store('heroes', 'public');
        } else {
            // Pake foto lama
            $photoPath = $hero->photo;
        }

        // Update Data Hero
        $hero->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random(5),
            'photo' => $photoPath,
            'story' => $request->story,
        ]);

        // Update Relasi (Pake 'sync' biar otomatis hapus yg lama, tambah yg baru)
        $hero->roles()->sync($request->roles);
        $hero->items()->sync($request->items);
        $hero->positions()->sync($request->positions);

        return redirect()->route('dashboard')->with('success', 'Hero berhasil diupdate!');
    }

    // 7. HAPUS HERO
    public function destroy(Hero $hero)
    {
        // Hapus fotonya dulu dari penyimpanan
        if ($hero->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($hero->photo);
        }

        // Hapus datanya dari database
        $hero->delete();

        return redirect()->route('dashboard')->with('success', 'Hero telah dihapus!');
    }
}