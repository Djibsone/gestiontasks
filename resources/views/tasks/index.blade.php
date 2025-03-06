@extends('layouts.template')

@section('content')
    @if (Session::get('success_message'))
        <div class="alert alert-success">{{ Session::get('success_message') }}</div>
    @endif

    @if (Session::get('error_message'))
        <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
    @endif

    <h1 class="app-page-title">Tableau de bord</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <h2>Mes Tâches</h2>
                    <a href="{{ route('tasks.store') }}" class="btn btn-info mb-3 text-white">Ajouter une nouvelle tâche</a>
                    <div class="row g-4 mb-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>TITRE</th>
                                    <th>DESCRIPTION</th>
                                    <th class="text-center">DATE DE CREATION</th>
                                    <th class="text-center">STATUT</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ ucfirst($task->title) }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td class="text-center">{{ date('d-m-Y, H:s:i', strtotime($task->created_at)) }}
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge 
                                        {{ $task->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ $task->status === 'completed' ? 'Tâche terminée' : 'Tâche en attente' }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('tasks.edit', encryptData($task->id)) }}" class="btn btn-warning">Modifier</a>
                                            @if ($task->status === 'completed')
                                                {{-- <span class="badge bg-success">Tâche complétée</span> --}}
                                            @else
                                                <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Marquer comme complétée</button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-danger delete-task"
                                                data-id="{{ encryptData($task->id) }}"
                                                data-name="{{ $task->title }}">Supprimer</button>
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

    <!-- Modal Suppression -->
    <div class="modal" id="delete-task-Modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Suppression de tâche</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <h5>Êtes-vous sûr de vouloir <span class="text text-lowercase"></span> <span class="text-danger"
                            id="delete-task-name"></span> ?</h5>
                    <p class="text-danger my-3 text-center"> Cette action est irréversible !</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form method="POST" class="deleteTaskForm" id="delete-task-form">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" id="delete-task-id">
                        <button type="submit" class="btn btn-danger" id="submitButton">
                            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            Oui, supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery3-6-0.js') }}"></script>
    {{-- <script src="{{ asset('assets/dataTables-b5.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-dataTables-bs5.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.delete-task').on('click', function() {
                var taskId = $(this).data('id');
                var taskName = $(this).data('name');
                $('#delete-task-name').text(taskName);
                $('#delete-task-id').val(taskId);

                var baseUrl = "{{ route('tasks.destroy', ['id' => ':id']) }}";
                var deleteAction = baseUrl.replace(':id', taskId);

                $('.deleteTaskForm').attr('action', deleteAction);
                $('#delete-task-Modal').modal('show');
            });

            $('.table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                order: [
                    [0, 'asc']
                ],
                pageLength: 10,
                language: {
                    search: "Rechercher :",
                    lengthMenu: "Afficher _MENU_ entrées",
                    info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    infoEmpty: "Aucune entrée trouvée",
                    infoFiltered: "(filtré de _MAX_ entrées au total)",
                    zeroRecords: "Aucun résultat trouvé",
                    emptyTable: "Aucune donnée disponible dans le tableau",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant",
                    },
                }
            });
        });
    </script>

    <script>
        function addSpinner(formId, buttonId, spinnerId) {
            const form = document.getElementById(formId);
            const submitButton = document.getElementById(buttonId);
            const spinner = document.getElementById(spinnerId);

            if (form && submitButton && spinner) {
                form.addEventListener("submit", function() {
                    submitButton.disabled = true;
                    spinner.classList.remove("d-none");
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            addSpinner("delete-task-form", "submitButton", "spinner");
        });
    </script>
@endsection

