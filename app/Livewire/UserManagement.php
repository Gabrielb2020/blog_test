<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserManagement extends Component
{
    /**
     * Verifica que el usuario sea administrador al cargar el componente.
     */
    public function mount()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Acceso denegado: Solo administradores pueden gestionar usuarios.');
        }
    }

    /**
     * Cambia el estado activo/inactivo de un usuario.
     *
     * @param int $userId ID del usuario a modificar
     */
    public function toggleActive($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['is_active' => !$user->is_active]);
    }

    /**
     * Renderiza la vista con la lista de usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // Excluye al usuario actual
        return view('livewire.user-management', compact('users'))->layout('layouts.app');
    }
}
