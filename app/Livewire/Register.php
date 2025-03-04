<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $birth_date = '';

    // Reglas de validación para los campos del formulario
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8|confirmed',
        'birth_date' => 'required|date|before:today',
    ];

    // Método para registrar un nuevo usuario
    public function register()
    {

        $this->validate();


        if (Carbon::parse($this->birth_date)->age < 18) {
            $this->addError('birth_date', 'Debes ser mayor de 18 años.');
            return;
        }

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'birth_date' => $this->birth_date,
                'is_active' => false,
                'is_admin' => false,
            ]);

            $this->dispatch('showAlert', 'Registro exitoso. Por favor, espera a que un administrador active tu cuenta.', 'success');
            $this->reset();
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al registrar el usuario.', 'error');
            Log::error('Excepción al registrar usuario', ['error' => $e->getMessage(), 'email' => $this->email]);
        }
    }

    // Renderiza la vista del componente
    public function render()
    {
        return view('livewire.register')->layout('layouts.auth');
    }
}
