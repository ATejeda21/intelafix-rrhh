<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleado;
use App\Models\Logro;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar temporalmente las FK para evitar errores al truncar
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpiar tablas
        Logro::truncate();
        Empleado::truncate();

        // Empleados
        $empleados = [
            [
                'nombres' => 'Juan Carlos',
                'apellidos' => 'Pérez García',
                'fecha_nacimiento' => '1990-05-15',
                'fotografia' => null,
                'puesto' => 'Vendedor',
                'salario' => 3500.00,
                'tienda' => 'Intelafix Central'
            ],
            [
                'nombres' => 'María Fernanda',
                'apellidos' => 'López Martínez',
                'fecha_nacimiento' => '1985-08-22',
                'fotografia' => null,
                'puesto' => 'Gerente',
                'salario' => 7500.00,
                'tienda' => 'Intelafix Miraflores'
            ],
            [
                'nombres' => 'Carlos Alberto',
                'apellidos' => 'Ramírez Soto',
                'fecha_nacimiento' => '1992-03-10',
                'fotografia' => null,
                'puesto' => 'Cajero',
                'salario' => 3000.00,
                'tienda' => 'Intelafix Oakland'
            ],
            [
                'nombres' => 'Ana Luisa',
                'apellidos' => 'Martínez Cruz',
                'fecha_nacimiento' => '1995-11-30',
                'fotografia' => null,
                'puesto' => 'Asistente de Ventas',
                'salario' => 2800.00,
                'tienda' => 'Intelafix Pradera'
            ],
            [
                'nombres' => 'Roberto José',
                'apellidos' => 'González Díaz',
                'fecha_nacimiento' => '1988-07-18',
                'fotografia' => null,
                'puesto' => 'Supervisor',
                'salario' => 5500.00,
                'tienda' => 'Intelafix Central'
            ],
            [
                'nombres' => 'Laura Patricia',
                'apellidos' => 'Hernández Ruiz',
                'fecha_nacimiento' => '1993-09-25',
                'fotografia' => null,
                'puesto' => 'Vendedor',
                'salario' => 3200.00,
                'tienda' => 'Intelafix Zona 10'
            ],
            [
                'nombres' => 'Miguel Ángel',
                'apellidos' => 'Torres Vega',
                'fecha_nacimiento' => '1991-02-14',
                'fotografia' => null,
                'puesto' => 'Técnico',
                'salario' => 4000.00,
                'tienda' => 'Intelafix Miraflores'
            ],
            [
                'nombres' => 'Sofía Isabel',
                'apellidos' => 'Morales Castillo',
                'fecha_nacimiento' => '1994-12-05',
                'fotografia' => null,
                'puesto' => 'Cajero',
                'salario' => 2900.00,
                'tienda' => 'Intelafix Oakland'
            ]
        ];

        foreach ($empleados as $empleado) {
            Empleado::create($empleado);
        }

        // Logros
        $logros = [
            [
                'empleado_id' => 1,
                'tipo' => 'Positivo',
                'descripcion' => 'Superó la meta de ventas del mes de octubre en un 25%, demostrando excelente desempeño',
                'fecha_ocurrencia' => '2024-10-30'
            ],
            [
                'empleado_id' => 2,
                'tipo' => 'Negativo',
                'descripcion' => 'Retraso en la entrega de reportes semanales durante tres semanas consecutivas',
                'fecha_ocurrencia' => '2024-10-15'
            ],
            [
                'empleado_id' => 3,
                'tipo' => 'Positivo',
                'descripcion' => 'Recibió reconocimiento por escrito de un cliente por su excelente atención y servicio',
                'fecha_ocurrencia' => '2024-10-20'
            ],
            [
                'empleado_id' => 4,
                'tipo' => 'Positivo',
                'descripcion' => 'Capacitó correctamente al nuevo personal en procedimientos de ventas y atención al cliente',
                'fecha_ocurrencia' => '2024-10-12'
            ],
            [
                'empleado_id' => 5,
                'tipo' => 'Positivo',
                'descripcion' => 'Implementó un nuevo sistema de organización que redujo tiempos de espera en un 30%',
                'fecha_ocurrencia' => '2024-10-18'
            ],
            [
                'empleado_id' => 1,
                'tipo' => 'Negativo',
                'descripcion' => 'Llegó tarde tres veces en la misma semana sin justificación adecuada',
                'fecha_ocurrencia' => '2024-09-25'
            ],
            [
                'empleado_id' => 6,
                'tipo' => 'Positivo',
                'descripcion' => 'Logró cerrar la venta más grande del mes en la categoría de equipos tecnológicos',
                'fecha_ocurrencia' => '2024-10-22'
            ],
            [
                'empleado_id' => 7,
                'tipo' => 'Positivo',
                'descripcion' => 'Resolvió exitosamente un problema técnico crítico fuera de horario laboral',
                'fecha_ocurrencia' => '2024-10-08'
            ],
            [
                'empleado_id' => 8,
                'tipo' => 'Negativo',
                'descripcion' => 'Error en el arqueo de caja con faltante de Q500.00 que fue descontado',
                'fecha_ocurrencia' => '2024-10-05'
            ],
            [
                'empleado_id' => 2,
                'tipo' => 'Positivo',
                'descripcion' => 'Lideró con éxito la apertura de una nueva sucursal cumpliendo todos los objetivos',
                'fecha_ocurrencia' => '2024-09-15'
            ]
        ];

        foreach ($logros as $logro) {
            Logro::create($logro);
        }

        // Volver a activar las FK
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}