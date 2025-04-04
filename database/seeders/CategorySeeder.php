<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Salud', 'color' => '#00BCD4', 'user_id' => 1], // Celeste
            ['name' => 'Finanzas', 'color' => '#4CAF50', 'user_id' => 1], // Verde
            ['name' => 'Trabajo', 'color' => '#FF9800', 'user_id' => 1], // Naranja
            ['name' => 'Educación', 'color' => '#3F51B5','user_id' => 1], // Azul oscuro
            ['name' => 'Desarrollo Personal', 'color' => '#9C27B0', 'user_id' => 1], // Morado
            ['name' => 'Relaciones', 'color' => '#E91E63', 'user_id' => 1], // Rosa
            ['name' => 'Ocio y Recreación', 'color' => '#FFC107', 'user_id' => 1], // Amarillo
            ['name' => 'Espiritualidad', 'color' => '#795548', 'user_id' => 1], // Café
        ]);
    }
}
