@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center md-4">
            <div class="col">
                <h1>
                    Crea Post
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
                            Titolo <span class="text-danger">*</span>
                        </label>
                        <input 
                        type="text" 
                        class="form-control" 
                        id="title" name="title" 
                        required maxlength="128" 
                        value="{{ old('title') }}"
                        placeholder="Inserisci il titolo..">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">
                            Contenuto <span class="text-danger">*</span>
                        </label>
                        <textarea 
                        class="form-control" 
                        rows="10" id="content" 
                        name="content" 
                        required maxlength="4096"
                        placeholder="Inserisci il contenuto..">{{ old('title') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">
                            Categoria
                        </label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">Nessuna categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
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

                    <div class="mb-3">
                        <label for="img" class="form-label">
                            Immagine in evidenza <span class="text-danger">*</span>
                        </label>
                        <input 
                        type="file" 
                        class="form-control" 
                        id="img" 
                        name="img" 
                        accept="image/*"
                        
                        {{-- accept="image/png,image/jpeg,image/svg" --}}
                        
                        {{-- Validazione frontend in qualche modo --}}
                        placeholder="Inserisci l'immagine in evidenza..">
                    </div>

                    <div>
                        <p>
                            N.B. i campi contrassegnati con <span class="text-danger">*</span> sono obbligatori
                        </p>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">
                            Aggiungi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
