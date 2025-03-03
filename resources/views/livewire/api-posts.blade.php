<div class="space-y-8 relative">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Posts de la API</h1>

    <!-- Campo de filtro por userId -->
    <div class="max-w-md mx-auto mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por User ID</label>
        <input wire:model.live="userIdFilter" type="number" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Ej. 1">
    </div>

    <!-- Lista de posts -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($filteredPosts as $post)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200">
                <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $post['title'] }}</h2>
                <p class="text-gray-700 text-sm line-clamp-3">{{ $post['body'] }}</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="editPost({{ json_encode($post) }})" class="px-4 py-1 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Editar</button>
                    <button wire:click="deletePost({{ $post['id'] }})" class="px-4 py-1 text-white bg-red-600 rounded-lg hover:bg-red-700">Eliminar</button>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-600">No hay posts para mostrar.</p>
        @endforelse
    </div>

    <!-- Modal para editar post -->
    @if ($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Editar Post</h2>
                <form wire:submit.prevent="updatePost" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input wire:model="title" type="text" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('title') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cuerpo</label>
                        <textarea wire:model="body" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" rows="4"></textarea>
                        @error('body') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Cancelar</button>
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
