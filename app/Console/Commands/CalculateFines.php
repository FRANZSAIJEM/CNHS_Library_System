<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CalculateFines extends Command
{
    protected $signature = 'fines:calculate';
    protected $description = 'Calculate fines for overdue books';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now();

        // Get all borrowed books where the return date has passed
        $overdueBooks = BorrowedBook::where('date_return', '<', $today)->get();

        foreach ($overdueBooks as $book) {
            // Calculate the number of days overdue
            $daysOverdue = $today->diffInDays($book->date_return);

            // Calculate fines (e.g., $2 per day overdue)
            $fines = $daysOverdue * 2; // Adjust this calculation based on your fine rules

            // Update the fines for the book
            $book->fines = $fines;
            $book->save();

            // Optionally, notify the user about the fines
            $user = $book->user; // Assuming you have a relationship between BorrowedBook and User
            $user->notify(new FinesNotification($fines));
        }

        $this->info('Fines calculation completed.');
    }
}
