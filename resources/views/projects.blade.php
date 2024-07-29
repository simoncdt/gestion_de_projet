@extends('home')

@section('content')
<div class="container">
    <h1>Projects</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Create Project</a>

    <!-- Formulaire de filtre -->
    <form action="{{ route('projects.index') }}" method="GET" class="mb-3">
        <div class="form-row">
            <div class="col-md-3">
                <select name="project_id" class="form-control">
                    <option value="">Tout les projets</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">Tout les statuts</option>
                    <option value="terminée" {{ request('status') == 'terminée' ? 'selected' : '' }}>Terminée</option>
                    <option value="en cours" {{ request('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="en attente" {{ request('status') == 'en attente' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Affichage des projets et des tâches -->
    @foreach($projects as $project)
        <div class="card mb-3">
            <div class="card-header">
                <h2>{{ $project->name }}</h2>
            </div>
            <div class="card-header justify-content-end">
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary mx-2">Modifier</a>
                <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary mx-2">Voir</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Etes-vous sur de vouloir supprimer ce projet ?')">Supprimer</button>
                </form>
                <a href="{{ route('tasks.create', $project) }}" class="btn btn-success mx-2">Ajouter une tâche</a>
            </div>
            <div class="card-body">
                <p>{{ $project->description }}</p>
                @if($project->tasks->count() > 0)
                    <h3>Tâches:</h3>
                    <ul>
                        @foreach($project->tasks as $task)
                            <li>
                                <strong>{{ $task->title }}</strong> -: 
                                <span class="{{ $task->status == 'terminée' ? 'text-success' : ($task->status == 'en attente' ? 'text-secondary' : 'text-info') }}">
                                    {{ ucfirst($task->status) }}
                                </span>                                
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No tasks assigned to this project.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
