<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::withCount(['logros as logros_positivos' => function ($query) {
            $query->where('tipo', 'Positivo');
        }, 'logros as logros_negativos' => function ($query) {
            $query->where('tipo', 'Negativo');
        }])->get();
        
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $puestos = ['Vendedor', 'Gerente', 'Cajero', 'Asistente de Ventas', 'Supervisor', 'Técnico'];
        $tiendas = ['Intelafix Central', 'Intelafix Miraflores', 'Intelafix Oakland', 'Intelafix Pradera', 'Intelafix Zona 10'];
        
        return view('empleados.create', compact('puestos', 'tiendas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellidos' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'fecha_nacimiento' => 'required|date|before:today|after:1940-01-01',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'puesto' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0|max:999999.99',
            'tienda' => 'required|string|max:255',
        ], [
            'nombres.required' => 'El campo nombres es obligatorio',
            'nombres.regex' => 'El campo nombres solo debe contener letras',
            'apellidos.required' => 'El campo apellidos es obligatorio',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy',
            'fecha_nacimiento.after' => 'La fecha de nacimiento debe ser posterior a 1940',
            'fotografia.image' => 'El archivo debe ser una imagen',
            'fotografia.mimes' => 'La imagen debe ser formato: jpeg, png o jpg',
            'fotografia.max' => 'La imagen no debe superar los 2MB',
            'salario.required' => 'El salario es obligatorio',
            'salario.numeric' => 'El salario debe ser un número',
            'salario.min' => 'El salario debe ser mayor o igual a 0',
            'puesto.required' => 'El puesto es obligatorio',
            'tienda.required' => 'La tienda es obligatoria',
        ]);

        if ($request->hasFile('fotografia')) {
            $validated['fotografia'] = $request->file('fotografia')->store('empleados', 'public');
        }

        Empleado::create($validated);
        
        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente');
    }

    public function show(Empleado $empleado)
    {
        $empleado->load('logros');
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        $puestos = ['Vendedor', 'Gerente', 'Cajero', 'Asistente de Ventas', 'Supervisor', 'Técnico'];
        $tiendas = ['Intelafix Central', 'Intelafix Miraflores', 'Intelafix Oakland', 'Intelafix Pradera', 'Intelafix Zona 10'];
        
        return view('empleados.edit', compact('empleado', 'puestos', 'tiendas'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellidos' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'fecha_nacimiento' => 'required|date|before:today|after:1940-01-01',
            'fotografia' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'puesto' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0|max:999999.99',
            'tienda' => 'required|string|max:255',
        ], [
            'nombres.required' => 'El campo nombres es obligatorio',
            'nombres.regex' => 'El campo nombres solo debe contener letras',
            'apellidos.required' => 'El campo apellidos es obligatorio',
            'apellidos.regex' => 'El campo apellidos solo debe contener letras',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy',
            'fecha_nacimiento.after' => 'La fecha de nacimiento debe ser posterior a 1940',
            'fotografia.image' => 'El archivo debe ser una imagen',
            'fotografia.mimes' => 'La imagen debe ser formato: jpeg, png o jpg',
            'fotografia.max' => 'La imagen no debe superar los 2MB',
            'salario.required' => 'El salario es obligatorio',
            'salario.numeric' => 'El salario debe ser un número',
            'salario.min' => 'El salario debe ser mayor o igual a 0',
            'puesto.required' => 'El puesto es obligatorio',
            'tienda.required' => 'La tienda es obligatoria',
        ]);

        if ($request->hasFile('fotografia')) {
            // Eliminar foto anterior si existe
            if ($empleado->fotografia) {
                Storage::disk('public')->delete($empleado->fotografia);
            }
            $validated['fotografia'] = $request->file('fotografia')->store('empleados', 'public');
        }

        $empleado->update($validated);
        
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
    }

    public function destroy(Empleado $empleado)
    {
        // Eliminar foto si existe
        if ($empleado->fotografia) {
            Storage::disk('public')->delete($empleado->fotografia);
        }
        
        $empleado->delete();
        
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente');
    }

    // REPORTES PDF
    public function reporteGeneral()
    {
        $empleados = Empleado::all();
        $totalSalarios = $empleados->sum('salario');
        
        return view('reportes.preview-general', compact('empleados', 'totalSalarios'));
    }

    public function reporteGeneralPDF()
    {
        $empleados = Empleado::all();
        $totalSalarios = $empleados->sum('salario');
        
        $pdf = Pdf::loadView('reportes.pdf-general', compact('empleados', 'totalSalarios'));
        return $pdf->download('reporte_general_empleados.pdf');
    }

    public function reporteSalariosTienda()
    {
        $empleados = Empleado::orderBy('tienda')->orderBy('salario', 'desc')->get();
        $salariosPorTienda = $empleados->groupBy('tienda')->map(function ($grupo) {
            return [
                'empleados' => $grupo,
                'total' => $grupo->sum('salario')
            ];
        })->sortByDesc('total');
        
        return view('reportes.preview-salarios-tienda', compact('salariosPorTienda'));
    }

    public function reporteSalariosTiendaPDF()
    {
        $empleados = Empleado::orderBy('tienda')->orderBy('salario', 'desc')->get();
        $salariosPorTienda = $empleados->groupBy('tienda')->map(function ($grupo) {
            return [
                'empleados' => $grupo,
                'total' => $grupo->sum('salario')
            ];
        })->sortByDesc('total');
        
        $pdf = Pdf::loadView('reportes.pdf-salarios-tienda', compact('salariosPorTienda'));
        return $pdf->download('reporte_salarios_por_tienda.pdf');
    }
}