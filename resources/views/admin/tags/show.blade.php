@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center md-4">
        <div class="col">

            {{-- Aggiungo partials errors --}}
            @include('partials.success')

            <h1>
                {{ $tag->name }}
            </h1>

            <h6>
                Slug: {{ $tag->slug }}
            </h6>

            <h2>
                Articoli associati ({{ $tag->posts()->count() }})
            </h2>

            @if ($tag->posts()->count() > 0)
                <ul>
                    @foreach ($tag->posts as $post)
                        <li>
                            <a href="{{ route('admin.posts.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3>
                    Nessun articolo associato
                </h3>
            @endif
        </div>
    </div>
@endsection
