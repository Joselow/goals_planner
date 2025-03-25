<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Salud', 'color' => '#00BCD4'], // Celeste
            ['name' => 'Finanzas', 'color' => '#4CAF50'], // Verde
            ['name' => 'Trabajo', 'color' => '#FF9800'], // Naranja
            ['name' => 'Educación', 'color' => '#3F51B5'], // Azul oscuro
            ['name' => 'Desarrollo Personal', 'color' => '#9C27B0'], // Morado
            ['name' => 'Relaciones', 'color' => '#E91E63'], // Rosa
            ['name' => 'Ocio y Recreación', 'color' => '#FFC107'], // Amarillo
            ['name' => 'Espiritualidad', 'color' => '#795548'], // Café
        ]);
    }
}
