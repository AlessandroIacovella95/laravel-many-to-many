@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-outline-primary">Torna alla lista</a>
        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-outline-warning">Modifica</a>

        <h1 class="my-3">{{ $technology->label }}</h1>
        <div class="row g-5">
            <div class="col-12">
                <p>
                    <strong>Colore:</strong><br>
                    {{ $technology->color }}
                </p>
            </div>
        </div>
    </div>
@endsection
