//dashboard
<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-5">
                        <h2>Mes Tâches</h2>
                        <a href="{{ route('tasks.store') }}" class="btn btn-success mb-3">Ajouter une Tâche</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Modifier</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-info">Marquer comme Complétée</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->

@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Tableau de bord</h1>

    <div class="row g-4 mb-4">
        <h2>Mes Tâches</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-info">Marquer comme Complétée</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



//creation tache
<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creation d\'une tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-5">
                    <div class="container">
                            <h1>Créer une nouvelle tâche</h1>
                            <form action="{{ route('tasks.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
                                </div>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="description" class="form-label">Statut</label>
                                    <select class="form-control" name="status" id="status">
                                        <option>-- Sélectionnez --</option>
                                        <option value="pending">En attente</option>
                                        <option value="completed" selected>Valide</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <a href="{{ route('tasks.dashboard') }}" class="btn btn-secondary">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->

@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Création d'une tâche</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajout</h3>
            <div class="section-intro">Ajouter ici une nouvelle tâches</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre de la tâche<span class="ms-2" data-container="body"
                                    data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
                                        width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                                        <circle cx="8" cy="4.5" r="1" />
                                    </svg></span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-control" name="status" id="status">
                                <option>-- Sélectionnez --</option>
                                <option value="pending">En attente</option>
                                <option value="completed" selected>Valide</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" col="3" class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                   
                        <button type="submit" class="btn app-btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>            
        </div>
    </div>
@endsection

//modifiée
<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modification d\'une tâche') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-5">
                        <div class="container">
                            <h1>Modifier la tâche</h1>

                            <form action="{{ route('tasks.update', $task) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="title" class="form-label">Titre</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Statut</label>
                                    <select class="form-control" name="status" id="status">
                                        <option>-- Sélectionnez --</option>
                                        <option value="pending" @selected(old('status', $task->status) == 'pending')>En attente</option>
                                        <option value="completed" @selected(old('status', $task->status) == 'completed')>Valide</option>
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-success">Modifier</button>
                                <a href="{{ route('tasks.dashboard') }}" class="btn btn-secondary">Annuler</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->