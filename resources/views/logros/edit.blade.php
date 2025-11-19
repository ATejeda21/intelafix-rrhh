@extends('layouts.app')

@section('title', 'Editar Logro/Llamada')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-edit text-yellow-600 mr-3"></i>Editar Registro
            </h1>
            <p class="text-gray-600 mt-2">Modifique los datos del registro</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
            <div class="flex items-start">
                <i class="fas fa-exclamation-circle text-2xl mr-3 mt-1"></i>
                <div>
                    <p class="font-bold mb-2">Por favor corrija los siguientes errores:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('logros.update', $logro) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Empleado -->
            <div class="mb-6">
                <label for="empleado_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user text-blue-600 mr-2"></i>Empleado *
                </label>
                <select name="empleado_id" id="empleado_id" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('empleado_id') border-red-500 @enderror"
                    required>
                    <option value="">Seleccione un empleado</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('empleado_id', $logro->empleado_id) == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombre_completo }} - {{ $empleado->puesto }} ({{ $empleado->tienda }})
                        </option>
                    @endforeach
                </select>
                @error('empleado_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipo -->
            <div class="mb-6">
                <label for="tipo" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-blue-600 mr-2"></i>Tipo *
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:bg-green-50 {{ old('tipo', $logro->tipo) == 'Positivo' ? 'border-green-500 bg-green-50' : 'border-gray-300' }}">
                        <input type="radio" name="tipo" value="Positivo" class="mr-3" {{ old('tipo', $logro->tipo) == 'Positivo' ? 'checked' : '' }} required>
                        <div>
                            <i class="fas fa-thumbs-up text-green-600 text-2xl mr-2"></i>
                            <span class="font-semibold text-gray-800">Positivo</span>
                            <p class="text-sm text-gray-600">Logro o reconocimiento</p>
                        </div>
                    </label>
                    <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer transition hover:bg-red-50 {{ old('tipo', $logro->tipo) == 'Negativo' ? 'border-red-500 bg-red-50' : 'border-gray-300' }}">
                        <input type="radio" name="tipo" value="Negativo" class="mr-3" {{ old('tipo', $logro->tipo) == 'Negativo' ? 'checked' : '' }} required>
                        <div>
                            <i class="fas fa-thumbs-down text-red-600 text-2xl mr-2"></i>
                            <span class="font-semibold text-gray-800">Negativo</span>
                            <p class="text-sm text-gray-600">Llamada de atención</p>
                        </div>
                    </label>
                </div>
                @error('tipo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Fecha -->
            <div class="mb-6">
                <label for="fecha_ocurrencia" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-calendar text-blue-600 mr-2"></i>Fecha de Ocurrencia *
                </label>
                <input type="date" name="fecha_ocurrencia" id="fecha_ocurrencia" value="{{ old('fecha_ocurrencia', $logro->fecha_ocurrencia->format('Y-m-d')) }}" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fecha_ocurrencia') border-red-500 @enderror"
                    required>
                @error('fecha_ocurrencia')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-6">
                <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-align-left text-blue-600 mr-2"></i>Descripción *
                </label>
                <textarea name="descripcion" id="descripcion" rows="5" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('descripcion') border-red-500 @enderror"
                    placeholder="Describa detalladamente el logro o la llamada de atención (mínimo 10 caracteres)" 
                    required>{{ old('descripcion', $logro->descripcion) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Mínimo 10 caracteres, máximo 500 caracteres</p>
                @error('descripcion')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('logros.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Actualizar Registro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection