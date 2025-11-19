@extends('layouts.app')

@section('title', 'Reporte de Logros Positivos')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-file-pdf text-red-600 mr-3"></i>Reporte de Logros Positivos
        </h1>
        <a href="{{ route('reportes.logros-positivos.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
            <i class="fas fa-download mr-2"></i>Descargar PDF
        </a>
    </div>

    <div class="border-2 border-gray-300 rounded-lg p-8 bg-gray-50">
        <!-- Encabezado del reporte -->
        <div class="text-center mb-8 pb-6 border-b-2 border-gray-400">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">INTELAFIX</h2>
            <h3 class="text-xl font-semibold text-gray-700">Reporte de Logros Positivos</h3>
            <p class="text-gray-600 mt-2">Generado el {{ date('d/m/Y') }}</p>
        </div>

        <table class="min-w-full divide-y divide-gray-300 mb-6">
            <thead class="bg-green-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Fecha</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Empleado</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Puesto</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Descripción</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($logros as $logro)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $logro->fecha_ocurrencia->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900 font-semibold">{{ $logro->empleado->nombre_completo }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $logro->empleado->puesto }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $logro->descripcion }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay logros positivos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="text-center text-sm text-gray-600 mt-8 pt-6 border-t border-gray-300">
            <p>Total de logros positivos: <strong>{{ $logros->count() }}</strong></p>
            <p class="mt-2">Sistema de RRHH de Intelafix</p>
        </div>
    </div>
</div>
@endsection