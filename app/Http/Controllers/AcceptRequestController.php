<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book; // Import your Book model
use App\Models\AcceptedRequest; // Import your Book model
use App\Models\Notification;


class AcceptRequestController extends Controller
{
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
