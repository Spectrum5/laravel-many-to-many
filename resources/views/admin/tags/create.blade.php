@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center md-4">
            <div class="col">
                <h1>
                    Crea Tag
                </h1>
            </div>
        </div>

        {{-- Aggiungo partials errors --}}
        @include('partials.errors')

        <div class="row md-4">
            <div class="col">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Tag <span class="text-danger">*</span>
                        </label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="title" name="title" 
                        required maxlength="128" 
                        value="{{ old('title') }}"
                        placeholder="Inserisci tag..">
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block mb-2">
                            Tag
                        </label>
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input
                                    class="form-check-input"
                                    name="tags[]"
                                    type="checkbox"
                                    id="tag-{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                                    {{--
                                        ALTERNATIVA:
                                        @if (old('tags') && is_array(old('tags')) && count(old('tags')) > 0)
                                            {{ in_array($tag->id, old('tags')) ? 'checked' : '' }}
                                        @endif
                                    --}}
                                    value="{{ $tag->id }}">
                                <label class="form-check-label" for="tag-{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">
                            Aggiungi
                        </button>
                    </div>

                    <div>
                        <p>
                            N.B. i campi contrassegnati con <span class="text-danger">*</span> sono obbligatori
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
