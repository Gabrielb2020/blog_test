<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'user_id' => 1, // ID del admin
            'title' => 'Primer post',
            'description' => 'Este es el contenido del primer post.',
            'published_at' => now(),
        ]);
        Post::create([
            'user_id' => 1,
            'title' => 'Segundo post',
            'description' => 'Otro post de ejemplo.',
            'published_at' => now()->subDays(2),
        ]);
    }
}
