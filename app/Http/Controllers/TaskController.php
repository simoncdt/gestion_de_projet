<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{

    //task create
    public function create(Project $project) 
    {
        return view('create_task', compact('project'));
    }

    //task edit
    public function edit(Project $project, Task $task)
    {
        return view('create_task', compact('project', 'task'));
    }

    //task store 
    public function store(Request $request, Project $project)
    {
        // Validation des données entrantes
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        // Création de la tâche avec association au projet
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->status = $validatedData['status'];
        $task->project_id = $project->id; // Associer la tâche au projet
        $task->save();

        // Rediriger avec un message de succès
        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully.');
    }

    // update a task
    public function update(Request $request, Project $project, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|max:50',
        ]);

        $task->update($validatedData);

        return redirect()->route('projects.show', $project)->with('success', 'Task updated successfully.');
    }

    //destroy task
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Task deleted successfully.');
    }
}
