<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Test - {{ $title ?? 'Autenticación' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center">
    <!-- Componente global para manejar autenticación -->
    <livewire:auth-manager />

    <!-- Contenido principal -->
    <div class="p-4">
        <livewire:alert />
        {{ $slot }}
    </div>

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>
