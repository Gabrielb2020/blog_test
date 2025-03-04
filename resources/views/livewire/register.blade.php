<div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Registro</h1>

    {{-- Mensaje de éxito tras el registro --}}
    @if (session('message'))
        <p class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('message') }}</p>
    @endif

    <form wire:submit.prevent="register" class="space-y-4">
        <div>
            <label class="block text-gray-700">Nombre</label>
            <input wire:model.live="name" type="text" class="w-full p-2 border rounded focus:border-indigo-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Correo</label>
            <input wire:model.live="email" type="email" class="w-full p-2 border rounded focus:border-indigo-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Fecha de Nacimiento</label>
            <input wire:model.live="birth_date" type="date" class="w-full p-2 border rounded focus:border-indigo-500">
            @error('birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Contraseña</label>
            <input wire:model.live="password" type="password" class="w-full p-2 border rounded focus:border-indigo-500">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-gray-700">Confirmar Contraseña</label>
            <input wire:model.live="password_confirmation" type="password" class="w-full p-2 border rounded focus:border-indigo-500">
        </div>

        <div class="flex flex-col items-center">
            <button type="submit" class="btn-primero text-white">Registrarse</button>

            <!-- Botón "Ir al inicio" -->
            <strong class="mt-3 text-gray-500 hover:underline text-sm"><a href="{{ route('home') }}" >Ir al inicio</a></strong>
        </div>
    </form>
</div>
