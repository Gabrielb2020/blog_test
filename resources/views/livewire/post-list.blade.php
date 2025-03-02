<div class="space-y-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Publicaciones del Blog</h1>

    <div class="flex flex-wrap gap-6 p-4">
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200 flex flex-col mr-2 ">
                {{-- Header: Avatar, Nombre y Fecha --}}
                <div class="flex items-center mb-4 ">
                    {{-- Avatar SVG --}}
                    <svg class="w-6 h-6 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    </svg>


                    {{-- Nombre --}}
                    <span class="block text-sm font-semibold text-gray-900 mr-auto">{{ $post->user->name }}</span>

                    {{-- Fecha --}}
                    <span class="block text-xs text-gray-500">Publicado: {{ $post->published_at->format('d/m/Y') }}</span>
                </div>

                {{-- Contenido del post (debajo del header) --}}
                <div class="mt-2">
                    <h2 class="text-lg font-bold text-gray-800 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700 text-sm line-clamp-3">{{ $post->description }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Botón Register --}}
    <div class="text-center mt-8">
        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
            Register
        </a>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('users') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
            gestion de usuarios
        </a>

    </div>

    <a href="{{ route('login') }}" class="inline-block bg-gray-600 text-gray-500 px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-200">
        Login
    </a>
</div>
