<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\InventarioItem::create([
            'nombre' => 'Radio',
            'codigo_serie' => 'RAD-001',
            'cantidad' => 5
        ]);

        \App\Models\InventarioItem::create([
            'nombre' => 'Machete',
            'codigo_serie' => 'MACH-001',
            'cantidad' => 8
        ]);

        \App\Models\InventarioItem::create([
            'nombre' => 'Linterna',
            'codigo_serie' => 'LINT-001',
            'cantidad' => 10
        ]);

        \App\Models\InventarioItem::create([
            'nombre' => 'Esposas',
            'codigo_serie' => 'ESPO-001',
            'cantidad' => 6
        ]);

        \App\Models\InventarioItem::create([
            'nombre' => 'Chaleco Antibalas',
            'codigo_serie' => 'CHAL-001',
            'cantidad' => 4
        ]);
    }
}
