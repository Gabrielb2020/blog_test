<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiPosts extends Component
{
    public $posts = [];
    public $filteredPosts = [];
    public $userIdFilter = '';
    public $selectedPost = null;
    public $title = '';
    public $body = '';
    public $showModal = false;

    /**
     * Carga los posts de la API al montar el componente.
     */
    public function mount()
    {
        $this->loadPosts();
    }

    /**
     * Carga todos los posts desde la API JSONPlaceholder.
     */
    public function loadPosts()
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            $this->posts = $response->json();
            $this->filterPosts();
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al cargar los posts de la API.', 'error');
            Log::error('Excepción al cargar posts de la API', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Filtra los posts según el userId especificado.
     */
    public function filterPosts()
    {
        if ($this->userIdFilter === '') {
            $this->filteredPosts = $this->posts;
        } else {
            $this->filteredPosts = array_filter($this->posts, fn($post) => $post['userId'] == $this->userIdFilter);
        }
    }

    /**
     * Muestra el modal para editar un post.
     *
     * @param array $post
     */
    public function editPost($post)
    {
        $this->selectedPost = $post;
        $this->title = $post['title'];
        $this->body = $post['body'];
        $this->showModal = true;
    }

    /**
     * Actualiza un post mediante la API.
     */
    public function updatePost()
    {
        if (!$this->selectedPost) {
            return;
        }

        try {
            $response = Http::put("https://jsonplaceholder.typicode.com/posts/{$this->selectedPost['id']}", [
                'title' => $this->title,
                'body' => $this->body,
                'userId' => $this->selectedPost['userId'],
            ]);

            // Actualizamos el post localmente (simulación, ya que JSONPlaceholder no persiste cambios)
            $this->posts = array_map(function ($post) {
                if ($post['id'] === $this->selectedPost['id']) {
                    $post['title'] = $this->title;
                    $post['body'] = $this->body;
                }
                return $post;
            }, $this->posts);

            $this->filterPosts();
            $this->showModal = false;
            $this->dispatch('showAlert', 'Post actualizado exitosamente.', 'success');
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al actualizar el post.', 'error');
            Log::error('Excepción al actualizar post en la API', ['error' => $e->getMessage(), 'post_id' => $this->selectedPost['id']]);
        }
    }

    /**
     * Elimina un post mediante la API.
     *
     * @param int $postId
     */
    public function deletePost($postId)
    {
        try {
            Http::delete("https://jsonplaceholder.typicode.com/posts/{$postId}");

            // Simulamos la eliminación (JSONPlaceholder no persiste cambios)
            $this->posts = array_filter($this->posts, fn($post) => $post['id'] !== $postId);
            $this->filterPosts();
            $this->dispatch('showAlert', 'Post eliminado exitosamente.', 'success');
        } catch (\Exception $e) {
            $this->dispatch('showAlert', 'Error al eliminar el post.', 'error');
            Log::error('Excepción al eliminar post en la API', ['error' => $e->getMessage(), 'post_id' => $postId]);
        }
    }

    /**
     * Renderiza la vista del componente con la lista de posts.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.api-posts')->layout('layouts.app');
    }
}
