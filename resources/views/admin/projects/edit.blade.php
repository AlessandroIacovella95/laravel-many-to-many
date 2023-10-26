@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-success">Torna alla lista</a>
        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-outline-success">Dettagli</a>

        <h1 class="my-3">Modifica progetto</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                Correggi i seguenti errori

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="row">
            @method('PATCH')
            @csrf
            <div class="col-12">
                <label for="title" class="from-label">Titolo</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $project->title }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mt-3">
                <label for="type_id" class="from-label">Tipo</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Indefinito</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') ?? $project->type_id == $type->id) selected @endif>
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 my-3">
                <label for="description" class="from-label">Descrizione</label>
                <textarea name ="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="5">{{ old('description') ?? $project->description }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="url" class="from-label">Link</label>
                <input type="url" name ="url" id="url" class="form-control @error('url') is-invalid @enderror"
                    value="{{ old('url') ?? $project->url }}">
                @error('url')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mt-4">
                <button class="btn btn-success">Salva</button>
            </div>
        </form>
    </section>
@endsection
