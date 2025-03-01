<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostList extends Component
{
    // Variable pública para almacenar la fecha de búsqueda
    public $searchDate = '';

    /**
     * Renderiza la vista del componente Livewire.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Obtener publicaciones filtradas por fecha (si se proporciona)
        $posts = Post::when($this->searchDate, function ($query) {
            return $query->whereDate('published_at', $this->searchDate);
        })->latest('published_at')->get();

        return view('livewire.post-list', compact('posts'))
            ->layout('layouts.app'); // Hereda la plantilla base
    }
}
