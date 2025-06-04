<?php

namespace App\Http\Controllers;

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

        $bookmarks = $user->bookmarkedJobs()->paginate(9);

        $data = [
            'user' => $user,
            'bookmarks' => $bookmarks,
        ];

        return view('jobs.bookmarked', $data);
    }
}
