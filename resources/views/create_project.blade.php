@extends('home')

@section('content')
<form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" class="col-md-6 mx-auto">
    @csrf
    @if(isset($project))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Nom du Projet</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $project->name ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="description">Desciption</label>
        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $project->description ?? '') }}</textarea>
    </div>
    <div class="form-group">
        <label for="start_date">Date de debut</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date ?? '') }}" required>
    </div>
    <div class="form-group">
        <label for="end_date">Date de fin</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $project->end_date ?? '') }}" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            {{ isset($project) ? 'Modifier le projet' : 'Creer le projet' }}
        </button>
    </div>
</form>
@endsection
