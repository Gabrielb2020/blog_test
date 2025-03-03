<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $showSuccess = false;

    /**
     * Reglas de validación para el formulario de inicio de sesión.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * Intenta autenticar al usuario con las credenciales proporcionadas.
     */
    public function login()
    {
        $this->validate();

        try {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                // Muestra la alerta de éxito
                $this->showSuccess = true;
                // Emite un evento para que la vista maneje la redirección
                $this->dispatch('startRedirectTimer');
            } else {
                // Emite una alerta de error si las credenciales son incorrectas
                $this->dispatch('showAlert', 'Las credenciales proporcionadas son incorrectas.', 'error');
                Log::warning('Intento de login fallido', ['email' => $this->email]);
            }
        } catch (\Exception $e) {
            // Maneja excepciones inesperadas
            $this->dispatch('showAlert', 'Error inesperado al iniciar sesión.', 'error');
            Log::error('Excepción en login', ['error' => $e->getMessage(), 'email' => $this->email]);
        }
    }

    /**
     * Renderiza la vista del formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.login')->layout('layouts.app');
    }
}
