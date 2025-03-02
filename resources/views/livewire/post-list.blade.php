<div class="space-y-8 relative">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Publicaciones del Blog</h1>

    <div class="max-w-md mx-auto mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Buscar por fecha</label>
        <input type="date" wire:model.live="searchDate" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div class="flex flex-wrap gap-6 p-4">
        @forelse ($posts as $post)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 flex flex-col mr-2">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-gray-600 flex-shrink-0 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>
                    <div class="flex-1">
                        <span class="block text-sm font-semibold text-gray-900">{{ $post->user->name }}</span>
                        <span class="block text-xs text-gray-500">Publicado: {{ $post->published_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $post->title }}</h2>
                <p class="text-gray-700 text-sm line-clamp-3">{{ $post->description }}</p>
            </div>
        @empty
            <p class="text-center text-gray-600">No hay publicaciones para esta fecha.</p>
        @endforelse
    </div>

    <div class="text-center mt-8 space-x-4">
        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
            Register
        </a>
        <br>
        <a href="{{ route('login') }}" class="inline-block bg-gray-600 text-gray-500 px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-200">
            Login
        </a>
        <br>
        <a href="{{ route('users') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
            gestion de usuarios
        </a>
        <br>
        @auth
            @if (Auth::user()->is_active)
                <button wire:click="openModal" class="inline-block bg-green-600 text-gray-600 px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                    Crear Publicación
                </button>
            @endif
        @endauth
    </div>

    {{-- Modal para crear publicación --}}
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Nueva Publicación</h2>

                <form wire:submit.prevent="createPost" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input wire:model.live="title" type="text" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Título de la publicación">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea wire:model.live="description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" rows="4" placeholder="Escribe la descripción aquí"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Cancelar</button>
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
