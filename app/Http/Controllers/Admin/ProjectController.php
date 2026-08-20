<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $projects   = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('projects', 'public');

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($project->image);
            $data['image'] = $request->file('image')->store('projects', 'public');
        } else {
            unset($data['image']);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
