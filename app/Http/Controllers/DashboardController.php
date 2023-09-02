<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\book;


class DashboardController extends Controller
{
    public function index()
    {

        $totalStudents = User::where('is_admin', false)->count();
        $totalBooks = book::count();


        return view('dashboard')
        ->with('totalStudents', $totalStudents)
        ->with('totalBooks', $totalBooks);
    }
}
