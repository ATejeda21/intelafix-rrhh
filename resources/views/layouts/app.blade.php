<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelafix RRHH - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <div class="bg-white p-2 rounded-lg">
                            <i class="fas fa-building text-blue-600 text-2xl"></i>
                        </div>
                        <span class="text-white text-xl font-bold">Intelafix RRHH</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-1">
                    <a href="{{ route('empleados.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-200 {{ request()->is('empleados*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-users mr-2"></i>Empleados
                    </a>
                    <a href="{{ route('logros.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-200 {{ request()->is('logros*') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-trophy mr-2"></i>Logros
                    </a>
                    
                    <!-- Dropdown de Reportes -->
                    <div class="relative group">
                        <button class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition duration-200 {{ request()->is('reportes*') ? 'bg-blue-700' : ''}}">
                            <i class="fas fa-file-pdf mr-2"></i>Reportes
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="{{ route('reportes.general') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-t-lg transition">
                                <i class="fas fa-users text-blue-600 mr-2"></i>Empleados General
                            </a>
                            <a href="{{ route('reportes.salarios-tienda') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                                <i class="fas fa-dollar-sign text-green-600 mr-2"></i>Salarios por Tienda
                            </a>
                            <a href="{{ route('reportes.logros-positivos') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 transition">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>Logros Positivos
                            </a>
                            <a href="{{ route('reportes.llamadas-atencion') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-b-lg transition">
                                <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>Llamadas de Atención
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mensajes de éxito/error -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md animate-pulse" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-2xl mr-3"></i>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-2xl mr-3"></i>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Contenido principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center">
                <p>&copy; 2024 Intelafix - Sistema de Gestión de Recursos Humanos</p>
                <p class="text-sm text-gray-400 mt-2">Desarrollado con Laravel 11</p>
            </div>
        </div>
    </footer>

    <script>
        // Auto-ocultar mensajes después de 5 segundos
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>