<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->has('id_number_search')) {
            $idNumberSearch = $request->input('id_number_search');
            $query->where(function ($subquery) use ($idNumberSearch) {
                $subquery->where('id_number', 'LIKE', '%' . $idNumberSearch . '%')
                        ->orWhere('name', 'LIKE', '%' . $idNumberSearch . '%');
            });
        }

        $students = $query->get();

        return view('student', ['students' => $students]);
    }

    public function disableAccount($id)
    {
        $student = User::findOrFail($id);
        $student->is_disabled = true;
        $student->save();

        return redirect()->route('student')->with('success', 'Account disabled successfully.');
    }

    public function toggleAccountStatus($id)
    {
        $student = User::findOrFail($id);
        $student->is_disabled = !$student->is_disabled;
        $student->save();

        $message = $student->is_disabled ? 'Account disabled.' : 'Account enabled.';
        return redirect()->route('student')->with('success', $message);
    }

}
