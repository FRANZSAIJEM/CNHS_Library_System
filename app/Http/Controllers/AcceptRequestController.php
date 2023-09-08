<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book; // Import your Book model
use App\Models\AcceptedRequest; // Import your Book model
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AcceptRequestController extends Controller
{

    public function index(Request $request)
    {
        $query = book::query();
        $user = Auth::user();

        if ($request->has('request_search')) {
            $bookSearch = $request->input('request_search');
            $query->where(function ($subquery) use ($bookSearch) {
                $subquery->where('name', 'LIKE', '%' . $bookSearch . '%')
                        ->orWhere('id_number', 'LIKE', '%' . $bookSearch . '%');
            });
        }

        $bookLists = $query->get();

        return view('bookList', ['bookList' => $bookLists, 'user' => $user, 'book' => $book]);
    }

    public function acceptRequest(Request $request, User $user, Book $book)
    {
        // Assuming you have a "accepted_requests" table to store the accepted requests.
        $acceptedRequest = new AcceptedRequest();
        $acceptedRequest->user_id = $user->id;
        $acceptedRequest->book_id = $book->id;
        $acceptedRequest->book_title = $book->title;
        $acceptedRequest->borrower_id = $user->id;
        $acceptedRequest->date_borrow = now();
         // Retrieve the values from the form and format them as datetime values
        $acceptedRequest->date_pickup = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('date_pickup'));
        $acceptedRequest->date_return = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('date_return'));


        $fines = $request->input('fines');
        if ($acceptedRequest->date_return->isPast()) {
            $fines = $request->input('fines');
            if (!empty($fines)) {
                // Calculate the fines and store them with two decimal places
                $calculatedFines = (float) number_format($fines, 2, '.', '');
                $acceptedRequest->fines = $calculatedFines;

                // Store the calculated fines in the session
                $request->session()->put('fines', $calculatedFines);
            } else {
                $acceptedRequest->fines = null; // If no fines are provided, set it to null.
            }
        } else {
            // If the return date is in the future, set fines to null or any other desired action.
            $acceptedRequest->fines = null;
        }

        $acceptedRequest->save();

        // Detach the book from the user's requestedBooks relationship since it's been accepted.
        $user->requestedBooks()->detach($book);

        // Inside the store method
        $notificationText = "You Borrowed '{$book->title}' on " . now()->format('Y-m-d H:i A') . ".";
        $notification = new Notification([
            'user_id' => $user->id,
            'notification_text' => $notificationText,
        ]);
        $notification->save();

        // Redirect back to the previous page or wherever you want.
        return redirect()->back()->with('success', 'Request accepted and saved.');
    }
}
