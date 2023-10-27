@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-outline-success">Torna alla lista</a>
        <h1 class="my-3">Crea Tecnologia</h1>
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
        <form action="{{ route('admin.technologies.store') }}" method="POST" class="row">
            @csrf
            <div class="col-12">
                <label for="label" class="from-label">Tecnologia</label>
                <input type="text" name="label" id="label"
                    class="form-control @error('label') is-invalid @enderror">
                @error('label')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-2 mt-3">
                <label for="color" class="from-label">Colore</label>
                <input type="color" name ="color" id="color"
                    class="form-control @error('color') is-invalid @enderror">
                @error('color')
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
