<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // This is optional. it will make our code cleaner and less prone to errors

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = [
            'Web Developer',
            'Database Admin',
            'Software Engineer',
            'System Analyst',
        ];

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): String
    {
        $title = $request->input('title');
        $description = $request->input('description');

        return "Title: $title, Description: $description";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): String
    {
        return "Showing Job $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): String
    {
        return 'Edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): String
    {
        return 'Update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): String
    {
        return 'Destroy';
    }

    public function share(): String
    {
        return "Share";
    }
}
