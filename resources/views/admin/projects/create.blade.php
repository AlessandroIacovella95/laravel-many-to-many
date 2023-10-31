@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-success">Torna alla lista</a>
        <h1 class="my-3">Crea progetto</h1>
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
        <form action="{{ route('admin.projects.store') }}" method="POST" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-3">
                <label for="title" class="from-label">Titolo</label>
                <input type="text" name="title" id="title"
                    class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <label for="cover_image" class="from-label">Immagine</label>
                        <input type="file" name="cover_image" id="cover_image"
                            class="form-control @error('cover_image') is-invalid @enderror"
                            value="{{ old('cover_image') }}">
                        @error('cover_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="" alt="" class="img-fluid" id="cover_image_preview">
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <label for="type_id" class="from-label">Tipo</label>
                <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Indefinito</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->label }}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 mt-3">
                <div class="row form-check @error('technologies') is-invalid @enderror">
                    @foreach ($technologies as $technology)
                        <div class="col-2">
                            <input type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}"
                                value="{{ $technology->id }}" class="form-check-control my-2"
                                @if (in_array($technology->id, old('technologies', []))) checked @endif>
                            <label for="technology-{{ $technology->id }}">{{ $technology->label }}</label>
                        </div>
                    @endforeach
                </div>
                @error('technologies')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12 my-3">
                <label for="description" class="from-label">Descrizione</label>
                <textarea name ="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="5"></textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-12">
                <label for="url" class="from-label">Link</label>
                <input type="url" name ="url" id="url" class="form-control @error('url') is-invalid @enderror">
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

@section('scripts')
    <script type="text/javascript">
        const inputFileELement = document.getElementById('cover_image')
        const coverImagePreview = document.getElementById('cover_image_preview')

        if (!coverImagePreview.getAttribute('src')) {
            coverImagePreview.src = "https://placehold.co/400"
        }

        inputFileELement.addEventListener('change', function() {
            const [file] = this.files
            coverImagePreview.src = URL.createObjectURL(file);
        })
    </script>
@endsection
