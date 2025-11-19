<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logro;

class LogroSeeder extends Seeder
{
    public function run(): void
    {
        $logros = [
            ['empleado_id' => 1, 'tipo' => 'Positivo', 'descripcion' => 'Excelente desempeño en ventas del mes de octubre'],
            ['empleado_id' => 2, 'tipo' => 'Negativo', 'descripcion' => 'Retraso en la entrega de reportes semanales'],
            ['empleado_id' => 3, 'tipo' => 'Positivo', 'descripcion' => 'Recibió reconocimiento del cliente por atención'],
            ['empleado_id' => 4, 'tipo' => 'Positivo', 'descripcion' => 'Capacitó correctamente al nuevo personal'],
        ];

        foreach ($logros as $logro) {
            Logro::create($logro);
        }
    }
}
