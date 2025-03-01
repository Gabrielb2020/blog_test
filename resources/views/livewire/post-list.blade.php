<div class="container">
    <h1>Publicaciones del Blog</h1>

    @foreach ($posts as $post)
        <article class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->description }}</p>
            <small>Publicado el: {{ $post->published_at->format('d/m/Y') }}</small>
        </article>
        <hr>
    @endforeach

    {{-- Frase motivacional --}}
    {{-- "Care about people's approval and you will be their prisoner." --}}
</div>
