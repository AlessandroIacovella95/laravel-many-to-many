@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a class="btn btn-outline-success" href="{{ route('admin.projects.create') }}">Crea progetto</a>
        <a class="btn btn-outline-success" href="{{ route('admin.technologies.index') }}">Vai alle Tecnologie</a>

        <h1 class="my-3">Progetti</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tecnologie</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Link</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{!! $project->getTypeBadge() !!}</td>
                        <td>{!! $project->getTechnologyBadges() !!}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>{{ $project->url }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}">Mostra</a>
                            <a href="{{ route('admin.projects.edit', $project) }}">Modifica</a>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#delete-project-modal-{{ $project->id }}">Elimina</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Non ci sono progetti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('modals')
    @foreach ($projects as $project)
        <div class="modal fade" id="delete-project-modal-{{ $project->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $project->title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Vuoi davvero eliminare il progetto {{ $project->title }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Chiudi</button>

                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
