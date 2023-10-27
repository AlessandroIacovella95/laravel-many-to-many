@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a class="btn btn-outline-success" href="{{ route('admin.technologies.create') }}">Crea Tecnologia</a>
        <a class="btn btn-outline-success" href="{{ route('admin.projects.index') }}">Vai ai progetti</a>

        <h1 class="my-3">Tecnologie</h1>
        @if (session('message'))
            <div class="alert alert-{{ session('message_type') ?? 'info' }}">
                {{ session('message') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tecnologia</th>
                    <th scope="col">Colore</th>
                    <th scope="col" class="custom"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td>{{ $technology->label }}</td>
                        <td>{{ $technology->color }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.technologies.show', $technology) }}"><i
                                        class="text-dark fa-solid fa-arrow-up-right-from-square"></i></a>
                                <a href="{{ route('admin.technologies.edit', $technology) }}"><i
                                        class="mx-3 text-dark fa-solid fa-pencil"></i></a>
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#delete-technologies-modal-{{ $technology->id }}"><i
                                        class="text-danger fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Non ci sono Tecnologie</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('modals')
    @foreach ($technologies as $technology)
        <div class="modal fade" id="delete-technologies-modal-{{ $technology->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $technology->label }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Vuoi davvero eliminare la tecnologia {{ $technology->label }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Chiudi</button>

                        <form method="POST" action="{{ route('admin.technologies.destroy', $technology) }}">
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
