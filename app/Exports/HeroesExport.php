<?php

namespace App\Exports;

use App\Models\Hero;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HeroesExport implements FromCollection, WithHeadings, WithMapping
{
    // data yang mau di-export
    public function collection()
    {
        // ambil semua hero + relasi roles & positions (lane)
        return Hero::with(['roles', 'positions'])->get();
    }

    // ngatur isi tiap baris
    public function map($hero): array
    {
        return [
            $hero->id,
            $hero->name,
            // role dijadiin string, contoh: "Tank, Fighter"
            $hero->roles->pluck('name')->join(', '),

            // TAMBAHAN: lane / posisi hero, contoh: "Gold Lane, Mid"
            $hero->positions->pluck('name')->join(', '),

            $hero->created_at?->format('Y-m-d'),
        ];
    }

    // header kolom excel
    public function headings(): array
    {
        return [
            'ID',
            'Nama Hero',
            'Roles',
            'Lane',            // <<< TAMBAHAN HEADER
            'Tanggal Dibuat',
        ];
    }
}
