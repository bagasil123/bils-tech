<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalProjects', 'totalCategories'));
    }
}
