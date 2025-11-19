@extends('layouts.app')

@section('title', 'Logros y Llamadas de Atención')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-trophy text-yellow-500 mr-3"></i>Logros y Llamadas de Atención
        </h1>
        <a href="{{ route('logros.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Nuevo Registro
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-yellow-500 to-yellow-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Empleado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tipo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($logros as $logro)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        #{{ $logro->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($logro->empleado->fotografia)
                                <img src="{{ asset('storage/' . $logro->empleado->fotografia) }}" alt="{{ $logro->empleado->nombre_completo }}" class="h-10 w-10 rounded-full object-cover border-2 border-blue-500 mr-3">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold mr-3">
                                    {{ strtoupper(substr($logro->empleado->nombres, 0, 1)) }}{{ strtoupper(substr($logro->empleado->apellidos, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $logro->empleado->nombre_completo }}</div>
                                <div class="text-sm text-gray-500">{{ $logro->empleado->puesto }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($logro->tipo == 'Positivo')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-thumbs-up mr-1"></i>Positivo
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-thumbs-down mr-1"></i>Negativo
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <i class="fas fa-calendar text-blue-600 mr-2"></i>{{ $logro->fecha_ocurrencia->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ Str::limit($logro->descripcion, 80) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('logros.show', $logro) }}" class="text-blue-600 hover:text-blue-900 transition" title="Ver">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ route('logros.edit', $logro) }}" class="text-yellow-600 hover:text-yellow-900 transition" title="Editar">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <form action="{{ route('logros.destroy', $logro) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de eliminar este registro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Eliminar">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p class="text-lg">No hay registros de logros o llamadas de atención</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection