<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostList extends Component
{
    public $searchDate = '';
    public $title = '';
    public $description = '';
    public $showModal = false;

    /**
     * Reglas de validación para el formulario de publicación.
     *
     * @var array<string, string>
     */
    protected $rules = [
        'title' => 'required|string|min:3|max:255', // Título: mínimo 3 caracteres
        'description' => 'required|string|min:10|max:1000', // Descripción: entre 10 y 1000 caracteres
    ];

    /**
     * Mensajes personalizados para los errores de validación.
     *
     * @var array<string, string>
     */
    protected $messages = [
        'title.required' => 'El título es obligatorio.',
        'title.min' => 'El título debe tener al menos 3 caracteres.',
        'title.max' => 'El título no puede exceder los 255 caracteres.',
        'description.required' => 'La descripción es obligatoria.',
        'description.min' => 'La descripción debe tener al menos 10 caracteres.',
        'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
    ];

    /**
     * Escucha el evento 'postCreated' para refrescar la lista.
     */
    protected $listeners = ['postCreated' => '$refresh'];

    /**
     * Verifica mensajes flash al cargar el componente y los emite al componente Alert.
     */
    public function mount()
    {
        if (session()->has('alert_message')) {
            $this->dispatch('showAlert', session('alert_message'), session('alert_type', 'info'));
        }
    }

    /**
     * Crea una nueva publicación asociada al usuario autenticado.
     */
    public function createPost()
    {
        if (!Auth::check() || !Auth::user()->is_active) {
            $this->dispatch('showAlert', 'Solo usuarios activos pueden crear publicaciones.', 'error');
            Log::warning('Intento de creación de post por usuario no autorizado', ['user_id' => Auth::id()]);
            return;
        }

        try {
            $this->validate();

            Post::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'description' => $this->description,
                'published_at' => now(),
            ]);

            $this->reset(['title', 'description', 'showModal']);
            $this->dispatch('postCreated', 'Publicación creada exitosamente.', 'success');
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al crear la publicación.', 'error');
            Log::error('Excepción al crear post', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);
        }
    }

    /**
     * Abre el modal de creación de publicaciones.
     */
    public function openModal()
    {
        $this->showModal = true;
    }

    /**
     * Cierra el modal y limpia los campos.
     */
    public function closeModal()
    {
        $this->reset(['title', 'description', 'showModal']);
    }

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
     * Renderiza la vista del componente Livewire con la lista y el modal.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $posts = Post::with('user')
            ->when($this->searchDate, fn($query) => $query->whereDate('published_at', $this->searchDate))
            ->latest('published_at')
            ->get();

        return view('livewire.post-list', compact('posts'))->layout('layouts.app');
    }
}
