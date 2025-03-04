<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthManager extends Component
{
    /**
     * Cierra la sesión del usuario autenticado.
     */
    public function logout()
    {
        try {
            Auth::logout();
            $this->dispatch('showAlert', 'Sesión cerrada exitosamente.', 'success');
            return redirect()->route('home');
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al cerrar sesión.', 'error');
            Log::error('Excepción en logout', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Renderiza el componente (vacío, usado solo para funcionalidad).
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.auth-manager');
    }
}
