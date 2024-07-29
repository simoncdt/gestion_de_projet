<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    // Afficher tous les projets
    public function index(Request $request)
    {
        // Récupération des filtres depuis la requête
        $status = $request->get('status');
        $projectId = $request->get('project_id');

        // Filtrage des projets et des tâches
        $query = Project::query();

        if ($projectId) {
            $query->where('id', $projectId);
        }

        $projects = $query->with(['tasks' => function ($query) use ($status) {
            if ($status) {
                $query->where('status', $status);
            }
        }])->get();

        return view('projects', compact('projects', 'status', 'projectId'));
    }

    // Afficher le formulaire de création de projet
    public function create()
    {
        return view('create_project');
    }

    // Enregistrer un nouveau projet
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        Project::create($validatedData);
        
        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Afficher le formulaire de modification de projet
    public function edit(Project $project)
    {
        return view('create_project', compact('project'));
    }

    // Mettre à jour un projet
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $project->update($validatedData);
        
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // delete project
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    //show project
    public function show(Project $project) 
    {
        return view('project_details', compact('project'));
    }


}
