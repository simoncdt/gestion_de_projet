@extends('home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $project->name }}</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Date de début:</strong> {{ $project->start_date }}</p>
                        <p><strong>Date de fin:</strong> {{ $project->end_date }}</p>
                        <p><strong>Statut:</strong>
                            @if ($project->end_date < now())
                                <span class="badge badge-danger">Expired</span>
                            @else
                                <span class="badge badge-success">Active</span>
                            @endif
                        </p>
                    </div>
                    <div class=" justify-content-end">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary mx-2">Update</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Etes-vous sur de vouloir supprimer ce projet ?')">Delete</button>
                        </form>
                        <a href="{{ route('tasks.create', $project) }}" class="btn btn-success mx-2">Add Task</a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Tâches</h4>
                    </div>
                    <div class="card-body overflow-auto" style="height: 70vh;">
                        <ul class="list-group list-group-flush">
                            @forelse($project->tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $task->title }}</h5>
                                        <p class="text-muted mb-1">{{ $task->description }}</p>
                                        <span
                                            class="badge {{ $task->status == 'en attente' ? 'badge-secondary' : ($task->status == 'en cours' ? 'badge-info' : 'badge-success') }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('tasks.edit', ['project' => $project, 'task' => $task]) }}"
                                            class="btn btn-outline-primary btn-sm mx-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('tasks.destroy', ['project' => $project, 'task' => $task]) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm mx-1"
                                                onclick="return confirm('Etes-vous sûr de vouloir supprimer cette tâche ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted">Pas encore de tâche</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
