<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    /**
     * @desc    Get all users bookmark
     * @route   GET /bookmarks
     */
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

        $data = [
            'user' => $user,
            'bookmarks' => $bookmarks,
        ];

        return view('jobs.bookmarked', $data);
    }

    /**
     * @desc    Create new bookmark job
     * @route   POST /bookmarks
     */
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job already bookmarked
        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists())
        {
            return back()->with('status', 'Job is already bookmarked');
        }

        // Create a new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully');
    }
}
