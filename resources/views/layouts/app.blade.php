<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Test</title>

    {{-- Carga los estilos de Tailwind CSS compilados por Vite --}}
    @vite('resources/css/app.css')

    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<div class="container mx-auto p-6 flex-grow">
    {{ $slot }} {{-- Contenido dinámico --}}
</div>

{{-- Scripts de Livewire y Vite --}}
@livewireScripts
@vite('resources/js/app.js')
</body>
</html>
