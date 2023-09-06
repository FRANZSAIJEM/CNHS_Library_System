<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;

class BookListController extends Controller
{
    public function index(Request $request)
    {
        $query = book::query();

        if ($request->has('book_search')) {
            $bookSearch = $request->input('book_search');
            $query->where(function ($subquery) use ($bookSearch) {
                $subquery->where('title', 'LIKE', '%' . $bookSearch . '%')
                        ->orWhere('author', 'LIKE', '%' . $bookSearch . '%');
            });
        }

        $bookLists = $query->get();

        return view('bookList', ['bookList' => $bookLists]);
    }

    public function destroy(Request $request, $id)
    {
        // Find the book by its ID
        $book = Book::findOrFail($id);

        // Get the users who have requested this book
        $users = $book->requestedByUsers;

        // Detach the book from all users who requested it
        foreach ($users as $user) {
            $user->requestedBooks()->detach($book->id);
        }

        // Delete the book
        $book->delete();

        // Redirect back to the book list page or any other page you prefer
        return redirect()->route('bookList')->with('success', 'Book and associated requests deleted successfully');
    }


}
