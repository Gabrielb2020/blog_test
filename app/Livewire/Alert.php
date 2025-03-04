<?php

namespace App\Livewire;

use Livewire\Component;

class Alert extends Component
{
    public $message = '';
    public $type = 'info';
    public $show = false;

    /**
     * Escucha eventos para mostrar alertas.
     */
    protected $listeners = [
        'showAlert' => 'showAlert',
    ];

    /**
     * Método de montaje para mostrar alertas de sesión.
     */
    public function mount()
    {
        if (session()->has('message')) {
            $this->message = session('message');
            $this->type = session('message_type', 'info');
            $this->show = true;
        }
    }

    /**
     * Muestra una alerta con un mensaje y tipo específico.
     */
    public function showAlert($message, $type = 'info')
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;
    }

    /**
     * Cierra la alerta.
     */
    public function close()
    {
        $this->show = false;
    }

    /**
     * Renderiza la vista del componente de alerta.
     */
    public function render()
    {
        return view('livewire.alert');
    }
}
