<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * @desc    Show all users job listings
     * @route   GET /dashboard
     */

    public function index(): View
    {
        // Get logged in users
        $user = Auth::user();

        // Get the user listings
        $jobs = Job::where('user_id', $user->id)->get();

        $data = [
            'user' => $user,
            'jobs' => $jobs,
        ];

        return view('dashboard.index', $data);
    }
}
