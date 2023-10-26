@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-primary">Torna alla lista</a>
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-outline-warning">Modifica</a>

        <h1 class="my-3">{{ $project->title }}</h1>
        <div class="row g-5">
            <div class="col-12">
                <p>
                    <strong>Descrizione:</strong><br>
                    {{ $project->description }}
                </p>
            </div>
            <div class="col-4">
                <p>
                    <strong>Tipo:</strong><br>
                    {!! $project->getTypeBadge() !!}
                </p>
            </div>
            <div class="col-4">
                <p>
                    <strong>Slug:</strong><br>
                    {{ $project->slug }}
                </p>
            </div>
            <div class="col-4">
                <p>
                    <strong>Link:</strong><br>
                    {{ $project->url }}
                </p>
            </div>
        </div>
    </div>
@endsection
