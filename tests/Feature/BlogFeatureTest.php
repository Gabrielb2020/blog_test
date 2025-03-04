<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogFeatureTest extends TestCase
{
    /**
     * Test: el administrador por defecto pueda iniciar sesión.
     */
    public function test_admin_can_login()
    {
        // Crear un administrador temporal para la prueba
        $admin = User::factory()->create([
            'email' => 'testadmin@blogtest.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);

        Livewire::test('login')
            ->set('email', 'testadmin@blogtest.com')
            ->set('password', 'password123')
            ->call('login')
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($admin);

        // eliminar el usuario creado
        $admin->delete();
    }

    /**
     * Test: solo administradores puedan acceder a UserManagement.
     */
    public function test_only_admin_can_access_user_management()
    {
        // Caso 1: Usuario no autenticado
        Livewire::test('user-management')
            ->assertForbidden();

        // Caso 2: Usuario no administrador
        $user = User::factory()->create([
            'email' => 'regular@blogtest.com',
            'password' => bcrypt('password123'),
            'is_admin' => false,
            'is_active' => true,
        ]);
        Livewire::actingAs($user)
            ->test('user-management')
            ->assertForbidden();

        // Caso 3: Administrador
        $admin = User::factory()->create([
            'email' => 'admin2@blogtest.com',
            'password' => bcrypt('password123'),
            'is_admin' => true,
            'is_active' => true,
        ]);
        Livewire::actingAs($admin)
            ->test('user-management')
            ->assertOk();

        // Limpieza opcional
        $user->delete();
        $admin->delete();
    }

    /**
     * Test: usuario activo pueda crear un post desde PostList.
     */
    public function test_active_user_can_create_post()
    {
        $user = User::factory()->create([
            'email' => 'user@blogtest.com',
            'password' => bcrypt('password123'),
            'is_active' => true,
        ]);

        Livewire::actingAs($user)
            ->test('post-list')
            ->set('title', 'Nuevo Post de Prueba')
            ->set('description', 'Descripción de prueba')
            ->call('createPost')
            ->assertDispatched('postCreated')
            ->assertSee('Nuevo Post de Prueba');

        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'title' => 'Nuevo Post de Prueba',
            'description' => 'Descripción de prueba',
        ]);

        // eliminar el post y el usuario
        Post::where('title', 'Nuevo Post de Prueba')->delete();
        $user->delete();
    }
}
