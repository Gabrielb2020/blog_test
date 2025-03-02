<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostList extends Component
{
    // Variable publica para almcenar la fecha de bsqueda
    public $searchDate = '';

    // Variables para el formulario de creación de posts
    public $title = '';
    public $description = '';
    public $showModal = false;

    /**
     * Reglas de validación para el formulario de publicación.
     */
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    /**
     * Crea una nueva publicación asociada al usuario autenticado.
     */
    public function createPost()
    {
        // Verifica que el usuario esté autenticado y activo
        if (!Auth::check() || !Auth::user()->is_active) {
            $this->dispatch('error', 'Solo usuarios activos pueden crear publicaciones.');
            return;
        }

        $this->validate();

        Post::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'published_at' => now(),
        ]);

        // Limpia el formulario y cierra el modal
        $this->reset(['title', 'description', 'showModal']);
        $this->dispatch('postCreated', 'Publicación creada exitosamente.');
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
     * Renderiza la vista del componente Livewire con la lista y el modal.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Obtener publicaciones filtradas por fecha (si se proporciona)
        $posts = Post::with('user')
            ->when($this->searchDate, function ($query) {
                return $query->whereDate('published_at', $this->searchDate);
            })->latest('published_at')
            ->get();

        return view('livewire.post-list', compact('posts'))
            ->layout('layouts.app'); // Hereda la plantilla base
    }
}
