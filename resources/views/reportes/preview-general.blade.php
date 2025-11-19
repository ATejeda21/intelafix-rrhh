@extends('layouts.app')

@section('title', 'Reporte General de Empleados')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-file-pdf text-red-600 mr-3"></i>Reporte General de Empleados
        </h1>
        <a href="{{ route('reportes.general.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
            <i class="fas fa-download mr-2"></i>Descargar PDF
        </a>
    </div>

    <div class="border-2 border-gray-300 rounded-lg p-8 bg-gray-50">
        <!-- Encabezado del reporte -->
        <div class="text-center mb-8 pb-6 border-b-2 border-gray-400">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">INTELAFIX</h2>
            <h3 class="text-xl font-semibold text-gray-700">Reporte General de Empleados</h3>
            <p class="text-gray-600 mt-2">Generado el {{ date('d/m/Y') }}</p>
        </div>

        <!-- Tabla de empleados -->
        <table class="min-w-full divide-y divide-gray-300 mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Foto</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nombre Completo</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Puesto</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Tienda</th>
                    <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase">Salario</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($empleados as $empleado)
                <tr>
                    <td class="px-4 py-3">
                        @if($empleado->fotografia)
                            <img src="{{ asset('storage/' . $empleado->fotografia) }}" alt="{{ $empleado->nombre_completo }}" class="h-12 w-12 rounded-full object-cover">
                        @else
                            <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($empleado->nombres, 0, 1)) }}{{ strtoupper(substr($empleado->apellidos, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $empleado->nombre_completo }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $empleado->puesto }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $empleado->tienda }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 text-right font-semibold">Q{{ number_format($empleado->salario, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-200">
                <tr>
                    <td colspan="4" class="px-4 py-3 text-right text-sm font-bold text-gray-900">TOTAL DE SALARIOS:</td>
                    <td class="px-4 py-3 text-right text-lg font-bold text-green-600">Q{{ number_format($totalSalarios, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center text-sm text-gray-600 mt-8 pt-6 border-t border-gray-300">
            <p>Total de empleados: <strong>{{ $empleados->count() }}</strong></p>
            <p class="mt-2">Este reporte fue generado automáticamente por el Sistema de RRHH de Intelafix</p>
        </div>
    </div>
</div>
@endsection