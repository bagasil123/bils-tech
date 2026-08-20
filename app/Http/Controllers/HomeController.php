<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Profile;

class HomeController extends Controller
{
    public function index()
    {
        $profile = Profile::getSingleton();
        $categories = Category::with(['projects' => function ($q) {
            $q->latest();
        }])->has('projects')->get();

        return view('home', compact('profile', 'categories'));
    }
}
