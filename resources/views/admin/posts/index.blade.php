@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center md-4">
            <div class="col">
                <h1>
                    Tutti gli articoli
                </h1>

                <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
                    Aggiungi articolo
                </a>
            </div>
        </div>

        {{-- Aggiungo partials success --}}
        @include('partials.success')

        <div class="row md-4">
            <div class="col">
                <h4>
                    Cerca
                </h4>

                <form action="{{ route('admin.posts.index') }}" method="GET">
                    <div>
                        <input 
                        type="text" 
                        name="title" 
                        placeholder="Cerca per titolo.." 
                        class="form-control"
                        value="{{ request()->input('title') }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-secondary">
                            Cerca
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>
                                    @if ($post->category)
                                        <a href="{{ route('admin.categories.show', $post->category->id) }}">
                                            {{ $post->category->name }}
                                        </a>
                                    @else
                                        Nessuna categoria
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">
                                        Dettagli
                                    </a>

                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">
                                        Aggiorna
                                    </a>

                                    <form 
                                        class="d-inline-block" 
                                        action="{{ route('admin.posts.destroy', $post->id) }}" 
                                        method="POST"
                                        onsubmit="return confirm('sei sicuro di voler eliminare questo post?');">
                                        @csrf
                                        @method("DELETE")

                                        <button class="btn btn-danger">
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
