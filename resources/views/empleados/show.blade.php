@extends('layouts.app')

@section('title', 'Detalle del Empleado')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-8 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-id-card mr-3"></i>Información del Empleado
                </h1>
                <a href="{{ route('empleados.index') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-semibold px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Columna izquierda: Foto y datos básicos -->
                <div class="md:col-span-1">
                    <div class="text-center">
                        @if($empleado->fotografia)
                            <img src="{{ asset('storage/' . $empleado->fotografia) }}" alt="{{ $empleado->nombre_completo }}" class="w-48 h-48 rounded-full object-cover border-4 border-blue-500 mx-auto shadow-lg">
                        @else
                            <div class="w-48 h-48 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-6xl mx-auto shadow-lg">
                                {{ strtoupper(substr($empleado->nombres, 0, 1)) }}{{ strtoupper(substr($empleado->apellidos, 0, 1)) }}
                            </div>
                        @endif
                        <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $empleado->nombre_completo }}</h2>
                        <p class="text-gray-600 mt-1">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $empleado->puesto }}
                            </span>
                        </p>
                    </div>

                    <div class="mt-6 space-y-3">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Edad</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $empleado->fecha_nacimiento->age }} años
                            </p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-1">Fecha de Nacimiento</p>
                            <p class="text-lg font-semibold text-gray-800">
                                <i class="fas fa-calendar text-blue-600 mr-2"></i>{{ $empleado->fecha_nacimiento->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha: Información detallada -->
                <div class="md:col-span-2">
                    <!-- Información laboral -->
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">
                            <i class="fas fa-briefcase text-blue-600 mr-2"></i>Información Laboral
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600 mb-1">Tienda Asignada</p>
                                <p class="text-lg font-semibold text-gray-800">
                                    <i class="fas fa-store text-blue-600 mr-2"></i>{{ $empleado->tienda }}
                                </p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg border-2 border-green-200">
                                <p class="text-sm text-gray-600 mb-1">Salario Mensual</p>
                                <p class="text-2xl font-bold text-green-600">
                                    Q{{ number_format($empleado->salario, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas de logros -->
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">
                            <i class="fas fa-chart-bar text-blue-600 mr-2"></i>Estadísticas de Desempeño
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="bg-blue-50 p-4 rounded-lg text-center border-2 border-blue-200">
                                <p class="text-3xl font-bold text-blue-600">{{ $empleado->logros->count() }}</p>
                                <p class="text-sm text-gray-600 mt-1">Registros Totales</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg text-center border-2 border-green-200">
                                <p class="text-3xl font-bold text-green-600">{{ $empleado->logros_positivos }}</p>
                                <p class="text-sm text-gray-600 mt-1">Logros Positivos</p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg text-center border-2 border-red-200">
                                <p class="text-3xl font-bold text-red-600">{{ $empleado->logros_negativos }}</p>
                                <p class="text-sm text-gray-600 mt-1">Llamadas de Atención</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de logros -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">
                            <i class="fas fa-history text-blue-600 mr-2"></i>Historial de Logros y Llamadas
                        </h3>
                        @if($empleado->logros->count() > 0)
                        <div class="space-y-3 max-h-96 overflow-y-auto">
                            @foreach($empleado->logros->sortByDesc('fecha_ocurrencia') as $logro)
                            <div class="border-l-4 {{ $logro->tipo == 'Positivo' ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50' }} p-4 rounded-r-lg">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $logro->tipo == 'Positivo' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ $logro->tipo }}
                                        </span>
                                        <p class="text-gray-800 mt-2">{{ $logro->descripcion }}</p>
                                    </div>
                                    <p class="text-sm text-gray-600 ml-4">
                                        <i class="fas fa-calendar mr-1"></i>{{ $logro->fecha_ocurrencia->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <i class="fas fa-inbox text-gray-400 text-4xl mb-3"></i>
                            <p class="text-gray-600">No hay registros de logros o llamadas de atención</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-200">
                <a href="{{ route('empleados.edit', $empleado) }}" class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <i class="fas fa-edit mr-2"></i>Editar Empleado
                </a>
                <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de eliminar este empleado? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-trash mr-2"></i>Eliminar Empleado
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection