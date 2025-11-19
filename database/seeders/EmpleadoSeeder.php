<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;

class EmpleadoSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = [
            ['nombre' => 'Juan Perez', 'puesto' => 'Vendedor', 'tienda' => 'Intelafix Central'],
            ['nombre' => 'Maria Lopez', 'puesto' => 'Gerente', 'tienda' => 'Intelafix Miraflores'],
            ['nombre' => 'Carlos Ramirez', 'puesto' => 'Cajero', 'tienda' => 'Intelafix Oakland'],
            ['nombre' => 'Ana Martinez', 'puesto' => 'Asistente de Ventas', 'tienda' => 'Intelafix Pradera'],
        ];

        foreach ($empleados as $empleado) {
            Empleado::create($empleado);
        }
    }
}
