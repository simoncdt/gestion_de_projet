<!-- resources/views/tasks/create.blade.php -->
@extends('home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($project) ? 'Modifier la tâche' : 'Créer une tâche' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($task) ? route('tasks.update', ['project' => $project, 'task' => $task]) : route('tasks.store', $project) }}" method="POST">
                            @csrf
                            @if(isset($task))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label for="title">Task Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="en attente" {{ old('status', $task->status ?? '') == 'en attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="en cours" {{ old('status', $task->status ?? '') == 'en cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminée" {{ old('status', $task->status ?? '') == 'terminée' ? 'selected' : '' }}>Terminée</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($task) ? 'Update Task' : 'Create Task' }}
                                </button>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
