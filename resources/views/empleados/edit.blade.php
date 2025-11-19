@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-xl p-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-user-edit text-yellow-600 mr-3"></i>Editar Empleado
            </h1>
            <p class="text-gray-600 mt-2">Modifique los datos del empleado</p>
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

        <form action="{{ route('empleados.update', $empleado) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombres -->
                <div>
                    <label for="nombres" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-600 mr-2"></i>Nombres *
                    </label>
                    <input type="text" name="nombres" id="nombres" value="{{ old('nombres', $empleado->nombres) }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('nombres') border-red-500 @enderror"
                        placeholder="Ej: Juan Carlos" required>
                    @error('nombres')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div>
                    <label for="apellidos" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user text-blue-600 mr-2"></i>Apellidos *
                    </label>
                    <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('apellidos') border-red-500 @enderror"
                        placeholder="Ej: Pérez García" required>
                    @error('apellidos')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Nacimiento -->
                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-blue-600 mr-2"></i>Fecha de Nacimiento *
                    </label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento->format('Y-m-d')) }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fecha_nacimiento') border-red-500 @enderror"
                        required>
                    @error('fecha_nacimiento')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Puesto -->
                <div>
                    <label for="puesto" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-briefcase text-blue-600 mr-2"></i>Puesto *
                    </label>
                    <select name="puesto" id="puesto" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('puesto') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione un puesto</option>
                        @foreach($puestos as $puesto)
                            <option value="{{ $puesto }}" {{ old('puesto', $empleado->puesto) == $puesto ? 'selected' : '' }}>{{ $puesto }}</option>
                        @endforeach
                    </select>
                    @error('puesto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Salario -->
                <div>
                    <label for="salario" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-dollar-sign text-green-600 mr-2"></i>Salario (Q) *
                    </label>
                    <input type="number" name="salario" id="salario" value="{{ old('salario', $empleado->salario) }}" step="0.01" min="0"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('salario') border-red-500 @enderror"
                        placeholder="0.00" required>
                    @error('salario')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tienda -->
                <div>
                    <label for="tienda" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-store text-blue-600 mr-2"></i>Tienda *
                    </label>
                    <select name="tienda" id="tienda" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('tienda') border-red-500 @enderror"
                        required>
                        <option value="">Seleccione una tienda</option>
                        @foreach($tiendas as $tienda)
                            <option value="{{ $tienda }}" {{ old('tienda', $empleado->tienda) == $tienda ? 'selected' : '' }}>{{ $tienda }}</option>
                        @endforeach
                    </select>
                    @error('tienda')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Fotografía -->
            <div class="mt-6">
                <label for="fotografia" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-camera text-blue-600 mr-2"></i>Fotografía (Opcional)
                </label>
                
                @if($empleado->fotografia)
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Fotografía actual:</p>
                    <img src="{{ asset('storage/' . $empleado->fotografia) }}" alt="{{ $empleado->nombre_completo }}" class="h-32 w-32 rounded-lg object-cover border-2 border-blue-500">
                </div>
                @endif
                
                <input type="file" name="fotografia" id="fotografia" accept="image/jpeg,image/png,image/jpg"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fotografia') border-red-500 @enderror"
                    onchange="previewImage(event)">
                <p class="text-sm text-gray-500 mt-1">Formatos: JPG, JPEG, PNG. Tamaño máximo: 2MB. Dejar vacío para mantener la foto actual.</p>
                @error('fotografia')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                
                <!-- Vista previa de nueva imagen -->
                <div id="preview-container" class="mt-4 hidden">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Nueva fotografía:</p>
                    <img id="preview-image" src="" alt="Vista previa" class="h-32 w-32 rounded-lg object-cover border-2 border-blue-500">
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('empleados.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400text-gray-800 font-semibold rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>Actualizar Empleado
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection