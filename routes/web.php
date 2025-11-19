<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\LogroController;

Route::get('/', function () {
    return redirect()->route('empleados.index');
});

// Rutas de Empleados
Route::resource('empleados', EmpleadoController::class);

// Rutas de Logros
Route::resource('logros', LogroController::class);

// Rutas de Reportes
Route::prefix('reportes')->group(function () {
    Route::get('/empleados/general', [EmpleadoController::class, 'reporteGeneral'])->name('reportes.general');
    Route::get('/empleados/general/pdf', [EmpleadoController::class, 'reporteGeneralPDF'])->name('reportes.general.pdf');
    
    Route::get('/empleados/salarios-tienda', [EmpleadoController::class, 'reporteSalariosTienda'])->name('reportes.salarios-tienda');
    Route::get('/empleados/salarios-tienda/pdf', [EmpleadoController::class, 'reporteSalariosTiendaPDF'])->name('reportes.salarios-tienda.pdf');
    
    Route::get('/logros/positivos', [LogroController::class, 'reporteLogrosPositivos'])->name('reportes.logros-positivos');
    Route::get('/logros/positivos/pdf', [LogroController::class, 'reporteLogrosPositivosPDF'])->name('reportes.logros-positivos.pdf');
    
    Route::get('/logros/llamadas-atencion', [LogroController::class, 'reporteLlamadasAtencion'])->name('reportes.llamadas-atencion');
    Route::get('/logros/llamadas-atencion/pdf', [LogroController::class, 'reporteLlamadasAtencionPDF'])->name('reportes.llamadas-atencion.pdf');
});