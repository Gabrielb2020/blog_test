<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Test</title>

    {{-- Estilos de Livewire --}}
    @livewireStyles
</head>
<body>

{{-- Contenido dinámico de cada página Livewire --}}
{{ $slot }}

{{-- Scripts de Livewire --}}
@livewireScripts

</body>
</html>
