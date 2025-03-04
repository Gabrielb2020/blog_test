<div>
    @auth
        <div class="flex items-center ms-3">
            <div>
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <svg class="w-8 h-8 rounded-full text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 4a3 3 0 1 1 0 6 3 3 0 0 1 0-6zm0 14a7 7 0 0 1-5.937-3.312 5 5 0 0 1 11.874 0A7 7 0 0 1 12 20z"/>
                    </svg>
                </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm" id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm text-gray-900" role="none">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-sm font-medium text-gray-900 truncate" role="none">
                        {{ Auth::user()->email }}
                    </p>
                </div>
                <ul class="py-1" role="none">
                    <li>
                        <button wire:click="logout" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Cerrar Sesión</button>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</div>
