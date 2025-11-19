<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logro;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\Pdf;

class LogroController extends Controller
{
    public function index()
    {
        $logros = Logro::with('empleado')->orderBy('fecha_ocurrencia', 'desc')->get();
        return view('logros.index', compact('logros'));
    }

    public function create()
    {
        $empleados = Empleado::orderBy('apellidos')->get();
        return view('logros.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'tipo' => 'required|in:Positivo,Negativo',
            'descripcion' => 'required|string|min:10|max:500',
            'fecha_ocurrencia' => 'required|date|before_or_equal:today',
        ], [
            'empleado_id.required' => 'Debe seleccionar un empleado',
            'empleado_id.exists' => 'El empleado seleccionado no existe',
            'tipo.required' => 'Debe seleccionar el tipo de logro',
            'tipo.in' => 'El tipo debe ser Positivo o Negativo',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres',
            'descripcion.max' => 'La descripción no debe superar los 500 caracteres',
            'fecha_ocurrencia.required' => 'La fecha de ocurrencia es obligatoria',
            'fecha_ocurrencia.before_or_equal' => 'La fecha no puede ser futura',
        ]);

        Logro::create($validated);
        
        return redirect()->route('logros.index')->with('success', 'Logro registrado correctamente');
    }

    public function show(Logro $logro)
    {
        $logro->load('empleado');
        return view('logros.show', compact('logro'));
    }

    public function edit(Logro $logro)
    {
        $empleados = Empleado::orderBy('apellidos')->get();
        return view('logros.edit', compact('logro', 'empleados'));
    }

    public function update(Request $request, Logro $logro)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'tipo' => 'required|in:Positivo,Negativo',
            'descripcion' => 'required|string|min:10|max:500',
            'fecha_ocurrencia' => 'required|date|before_or_equal:today',
        ], [
            'empleado_id.required' => 'Debe seleccionar un empleado',
            'empleado_id.exists' => 'El empleado seleccionado no existe',
            'tipo.required' => 'Debe seleccionar el tipo de logro',
            'tipo.in' => 'El tipo debe ser Positivo o Negativo',
            'descripcion.required' => 'La descripción es obligatoria',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres',
            'descripcion.max' => 'La descripción no debe superar los 500 caracteres',
            'fecha_ocurrencia.required' => 'La fecha de ocurrencia es obligatoria',
            'fecha_ocurrencia.before_or_equal' => 'La fecha no puede ser futura',
        ]);

        $logro->update($validated);
        
        return redirect()->route('logros.index')->with('success', 'Logro actualizado correctamente');
    }

    public function destroy(Logro $logro)
    {
        $logro->delete();
        
        return redirect()->route('logros.index')->with('success', 'Logro eliminado correctamente');
    }

    // REPORTES PDF
    public function reporteLogrosPositivos()
    {
        $logros = Logro::with('empleado')->where('tipo', 'Positivo')->orderBy('fecha_ocurrencia', 'desc')->get();
        return view('reportes.preview-logros-positivos', compact('logros'));
    }

    public function reporteLogrosPositivosPDF()
    {
        $logros = Logro::with('empleado')->where('tipo', 'Positivo')->orderBy('fecha_ocurrencia', 'desc')->get();
        $pdf = Pdf::loadView('reportes.pdf-logros-positivos', compact('logros'));
        return $pdf->download('reporte_logros_positivos.pdf');
    }

    public function reporteLlamadasAtencion()
    {
        $logros = Logro::with('empleado')->where('tipo', 'Negativo')->orderBy('fecha_ocurrencia', 'desc')->get();
        return view('reportes.preview-llamadas-atencion', compact('logros'));
    }

    public function reporteLlamadasAtencionPDF()
    {
        $logros = Logro::with('empleado')->where('tipo', 'Negativo')->orderBy('fecha_ocurrencia', 'desc')->get();
        $pdf = Pdf::loadView('reportes.pdf-llamadas-atencion', compact('logros'));
        return $pdf->download('reporte_llamadas_atencion.pdf');
    }
}