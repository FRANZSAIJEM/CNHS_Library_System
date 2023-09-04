<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\book;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('is_admin', false)->count();
        $totalBooks = Book::count();

        // Calculate the total number of distinct user-book pairs
        $totalRequests = DB::table('book_requests')->count();

        return view('dashboard')
            ->with('totalStudents', $totalStudents)
            ->with('totalBooks', $totalBooks)
            ->with('totalRequests', $totalRequests);
    }
}
