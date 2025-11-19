@extends('layouts.app')

@section('title', 'Empleados')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-users text-blue-600 mr-3"></i>Lista de Empleados
        </h1>
        <a href="{{ route('empleados.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Nuevo Empleado
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre Completo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Puesto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tienda</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Salario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Logros</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($empleados as $empleado)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($empleado->fotografia)
                            <img src="{{ asset('storage/' . $empleado->fotografia) }}" alt="{{ $empleado->nombre_completo }}" class="h-12 w-12 rounded-full object-cover border-2 border-blue-500">
                        @else
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($empleado->nombres, 0, 1)) }}{{ strtoupper(substr($empleado->apellidos, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $empleado->nombre_completo }}</div>
                        <div class="text-sm text-gray-500">{{ $empleado->fecha_nacimiento->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $empleado->puesto }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <i class="fas fa-store text-blue-600 mr-2"></i>{{ $empleado->tienda }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                        Q{{ number_format($empleado->salario, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                <i class="fas fa-thumbs-up mr-1"></i>{{ $empleado->logros_positivos }}
                            </span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                <i class="fas fa-thumbs-down mr-1"></i>{{ $empleado->logros_negativos }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('empleados.show', $empleado) }}" class="text-blue-600 hover:text-blue-900 transition" title="Ver">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{ route('empleados.edit', $empleado) }}" class="text-yellow-600 hover:text-yellow-900 transition" title="Editar">
                                <i class="fas fa-edit text-lg"></i>
                            </a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de eliminar este empleado?')">
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
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p class="text-lg">No hay empleados registrados</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection