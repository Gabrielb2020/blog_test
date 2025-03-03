<div class="max-w-md mx-auto space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 text-center">Iniciar Sesión</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <!-- Alerta de exito con temporizador -->
        <div x-data="{ show: @entangle('showSuccess') }"
             x-show="show"
             x-transition
             class="mb-4 p-4 bg-green-50 text-green-800 rounded-lg shadow-md flex items-center">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="ms-3 text-sm font-medium">Inicio de sesión exitoso.</span>
        </div>

        <form wire:submit.prevent="login" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input wire:model.live="email" type="email" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="admin@blogtest.com">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input wire:model.live="password" type="password" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition duration-200">Iniciar Sesión</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('startRedirectTimer', () => {
            setTimeout(() => {
                window.location.href = "{{ route('home') }}";
            }, 3000); // Redirección después de 3 segundos
        });
    });
</script>
