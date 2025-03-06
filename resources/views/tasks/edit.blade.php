@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Modification d'une tâche</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form action="{{ route('tasks.update', $task) }}" method="POST" id="taskForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre de la tâche<span class="ms-2 text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="3" cols="5" class="form-control" style="height: 166px;">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut<span class="ms-2 text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option>-- Sélectionnez --</option>
                                <option value="pending" @selected(old('status', $task->status) == 'pending')>En attente</option>
                                <option value="completed" @selected(old('status', $task->status) == 'completed')>Terminée</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <em>
                            <p class="text-info mt-2">Les champs marqués d'un astérisque (<span class="text-danger">*</span>)
                                sont obligatoires.</p>
                        </em>
                   
                        <button type="submit" class="btn btn-warning mt-4" id="submitButton">
                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Modifier la tâche
                        </button>
                    </form>
                </div>
            </div>            
        </div>
    </div>

    <script>
        function addSpinner(formId, buttonId, spinnerId) {
            const form = document.getElementById(formId);
            const submitButton = document.getElementById(buttonId);
            const spinner = document.getElementById(spinnerId);

            if (form && submitButton && spinner) {
                form.addEventListener("submit", function () {
                    submitButton.disabled = true;
                    spinner.classList.remove("d-none");
                });
            }
        }

    document.addEventListener("DOMContentLoaded", function () {
        addSpinner("taskForm", "submitButton", "spinner");
    });
    </script>
@endsection