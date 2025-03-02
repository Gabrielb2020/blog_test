<div class="max-w-md mx-auto space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 text-center">Iniciar Sesión</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form wire:submit.prevent="login" class="space-y-4">
            {{-- Campo de correo electrónico --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input
                    wire:model.live="email"
                    type="email"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="admin@blogtest.com"
                >
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Campo de contraseña --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input
                    wire:model.live="password"
                    type="password"
                    class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="••••••••"
                >
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Botón de inicio de sesión --}}
            <button
                type="submit"
                class="w-full bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition duration-200"
            >
                Iniciar Sesión
            </button>
        </form>
    </div>
</div>
