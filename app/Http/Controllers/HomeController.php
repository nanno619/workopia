<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @desc Show home index view
     * @route GET /
     */
    public function index(): View
    {
        $jobs = Job::latest()->limit(6)->get();

        $data = [
            'jobs' => $jobs,
        ];

        return view('pages.index', $data);
    }
}
