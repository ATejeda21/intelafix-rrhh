@extends('layouts.app')

@section('title', 'Detalle del Registro')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r {{ $logro->tipo == 'Positivo' ? 'from-green-500 to-green-700' : 'from-red-500 to-red-700' }} px-8 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas {{ $logro->tipo == 'Positivo' ? 'fa-star' : 'fa-exclamation-triangle' }} mr-3"></i>Detalle del Registro
                </h1>
                <a href="{{ route('logros.index') }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
            </div>
        </div>

        <!-- Contenido -->
        <div class="p-8">
            <!-- Información del empleado -->
            <div class="mb-6 pb-6 border-b-2 border-gray-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Información del Empleado
                </h2>
                <div class="flex items-center">
                    @if($logro->empleado->fotografia)
                        <img src="{{ asset('storage/' . $logro->empleado->fotografia) }}" alt="{{ $logro->empleado->nombre_completo }}" class="h-20 w-20 rounded-full object-cover border-4 border-blue-500 mr-4">
                    @else
                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-2xl mr-4">
                            {{ strtoupper(substr($logro->empleado->nombres, 0, 1)) }}{{ strtoupper(substr($logro->empleado->apellidos, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $logro->empleado->nombre_completo }}</h3>
                        <p class="text-gray-600 mt-1">
                            <i class="fas fa-briefcase text-blue-600 mr-2"></i>{{ $logro->empleado->puesto }}
                        </p>
                        <p class="text-gray-600 mt-1">
                            <i class="fas fa-store text-blue-600 mr-2"></i>{{ $logro->empleado->tienda }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Información del registro -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Detalles del Registro
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">Tipo de Registro</p>
                        @if($logro->tipo == 'Positivo')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-thumbs-up mr-2"></i>Logro Positivo
                            </span>
                        @else
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-thumbs-down mr-2"></i>Llamada de Atención
                            </span>
                        @endif
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">Fecha de Ocurrencia</p>
                        <p class="text-lg font-semibold text-gray-800">
                            <i class="fas fa-calendar text-blue-600 mr-2"></i>{{ $logro->fecha_ocurrencia->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Hace {{ $logro->fecha_ocurrencia->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <div class="bg-{{ $logro->tipo == 'Positivo' ? 'green' : 'red' }}-50 border-2 border-{{ $logro->tipo == 'Positivo' ? 'green' : 'red' }}-200 p-6 rounded-lg">
                    <p class="text-sm text-gray-600 mb-2 font-semibold">Descripción:</p>
                    <p class="text-gray-800 text-lg leading-relaxed">{{ $logro->descripcion }}</p>
                </div>
            </div>

            <!-- Metadatos -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-xs text-gray-500">
                    <i class="fas fa-clock mr-1"></i>Registrado el: {{ $logro->created_at->format('d/m/Y H:i') }}
                </p>
                @if($logro->created_at != $logro->updated_at)
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-edit mr-1"></i>Última actualización: {{ $logro->updated_at->format('d/m/Y H:i') }}
                </p>
                @endif
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t-2 border-gray-200">
                <a href="{{ route('logros.edit', $logro) }}" class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <i class="fas fa-edit mr-2"></i>Editar Registro
                </a>
                <form action="{{ route('logros.destroy', $logro) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de eliminar este registro? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-trash mr-2"></i>Eliminar Registro
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection