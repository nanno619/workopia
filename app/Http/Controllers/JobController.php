<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; // This is optional. it will make our code cleaner and less prone to errors
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * @desc Show all job listings
     * @route GET /jobs
     */
    public function index(): View
    {
        $data = [
            'jobs' => Job::all(),
        ];

        return view('jobs.index', $data);
    }

    /**
     * @desc Show create job form
     * @route GET /jobs/create
     */
    public function create()
    {
        /**
         * Authorization
         * Option 1
         * It is a hassle to do this in every controller
         */
        // If not logged in
        // if(!Auth::check()){
        //     return redirect()->route('login');
        // }

        return view('jobs.create');
    }

    /**
     * @desc Save job to database
     * @route POST /jobs
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->file('company_logo'));

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', //max = size
            'company_website' => 'nullable|url',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        // Check for image
        if($request->hasFile('company_logo'))
        {
            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Submit to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job Listing created successfully!');
    }

    /**
     * @desc Display a single job listing
     * @route GET /jobs/{$id}
     */
    public function show(Job $job): View
    {
        $data = ['job' => $job];

        return view('jobs.show', $data);
    }

    /**
     * @desc Show edit job form
     * @route GET /jobs/{$id}/edit
     */
    public function edit(Job $job): View
    {
        // Check if user is authorized
        $this->authorize('update', $job);

        $data = [
            'job' => $job,
        ];

        return view('jobs.edit', $data);
    }

    /**
     * @desc Update job listing
     * @route PUT /jobs/{$id}
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        // Check if user is authorized
        $this->authorize('update', $job);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', //max = size
            'company_website' => 'nullable|url',
        ]);

        // Check for image
        if($request->hasFile('company_logo'))
        {
            // Delete Old Logo
            Storage::delete('public/logos/' . basename($job->company_logo));

            // Store the file and get path
            $path = $request->file('company_logo')->store('logos', 'public');

            // Add path to validated data
            $validatedData['company_logo'] = $path;
        }

        // Submit to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job Listing updated successfully!');
    }

    /**
     * @desc Delete job listing
     * @route DELETE /jobs/{$id}
     */
    public function destroy(Job $job): RedirectResponse
    {
        // Check if user is authorized
        $this->authorize('delete', $job);

        // If logo, then delete it
        if($job->company_logo){
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job Listing deleted successfully!');
    }
}
