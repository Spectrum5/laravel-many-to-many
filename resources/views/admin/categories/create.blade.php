@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center md-4">
            <div class="col">
                <h1>
                    Crea Categoria
                </h1>
            </div>
        </div>

        {{-- Aggiungo partials errors --}}
        @include('partials.errors')

        <div class="row md-4">
            <div class="col">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
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
                        placeholder="Inserisci categoria..">
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
