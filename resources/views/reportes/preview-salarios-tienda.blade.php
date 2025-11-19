@extends('layouts.app')

@section('title', 'Reporte de Salarios por Tienda')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-file-pdf text-red-600 mr-3"></i>Reporte de Salarios por Tienda
        </h1>
        <a href="{{ route('reportes.salarios-tienda.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
            <i class="fas fa-download mr-2"></i>Descargar PDF
        </a>
    </div>

    <div class="border-2 border-gray-300 rounded-lg p-8 bg-gray-50">
        <!-- Encabezado del reporte -->
        <div class="text-center mb-8 pb-6 border-b-2 border-gray-400">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">INTELAFIX</h2>
            <h3 class="text-xl font-semibold text-gray-700">Reporte de Salarios por Tienda</h3>
            <p class="text-gray-600 mt-2">Generado el {{ date('d/m/Y') }}</p>
        </div>

        @foreach($salariosPorTienda as $tienda => $datos)
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 bg-blue-100 px-4 py-2 rounded-t-lg border-b-2 border-blue-500">
                <i class="fas fa-store text-blue-600 mr-2"></i>{{ $tienda }}
            </h3>
            <table class="min-w-full divide-y divide-gray-300 mb-4">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase">Puesto</th>
                        <th class="px-4 py-3 text-right text-xs font-bold text-gray-700 uppercase">Salario</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($datos['empleados'] as $empleado)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $empleado->nombre_completo }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $empleado->puesto }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-right font-semibold">Q{{ number_format($empleado->salario, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-blue-50">
                    <tr>
                        <td colspan="2" class="px-4 py-3 text-right text-sm font-bold text-gray-900">Subtotal {{ $tienda }}:</td>
                        <td class="px-4 py-3 text-right text-base font-bold text-blue-600">Q{{ number_format($datos['total'], 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endforeach

        <div class="bg-green-100 p-4 rounded-lg border-2 border-green-500">
            <div class="flex justify-between items-center">
                <span class="text-lg font-bold text-gray-900">TOTAL GENERAL:</span>
                <span class="text-2xl font-bold text-green-600">Q{{ number_format($salariosPorTienda->sum('total'), 2) }}</span>
            </div>
        </div>

        <div class="text-center text-sm text-gray-600 mt-8 pt-6 border-t border-gray-300">
            <p>Este reporte muestra los salarios ordenados de mayor a menor por tienda</p>
            <p class="mt-2">Sistema de RRHH de Intelafix</p>
        </div>
    </div>
</div>
@endsection