<div class="max-w-3xl mx-auto space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 text-center">Gestión de Usuarios</h1>

{{-- Tabla de usuarios --}}
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse ($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right">
                    <button
                        wire:click="toggleActive({{ $user->id }})"
                        class="px-4 py-1 text-white rounded-lg text-sm {{ $user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} transition duration-200"
                    >
                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</div>
