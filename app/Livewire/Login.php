<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';

    /**
     * Reglas de validación para el formulario de inicio de sesión.
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

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Redirige a la página de home tras un login exitoso
            return redirect()->route('home');
        }

        // Muestra un error si las credenciales son incorrectas
        $this->addError('email', 'Las credenciales proporcionadas son incorrectas.');
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
