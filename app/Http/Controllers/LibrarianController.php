<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LibrarianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayUsers(Request $request) {
        $searchString = $request->searchUser;

        $users = User::where('name', 'like', '%'.$searchString.'%')
            ->orWhere('email', 'like', '%'.$searchString.'%')
            ->get();


        return view('librarian.display_users', [
            'users' => $users,
        ]);
    }

    public function searchUsers() {
        return view('librarian.search_users');
    }

    public function displayUser(User $user) {

        $books = $user->customerLoans;
        $reservations = [];
        $loans = [];

        foreach ($books as $book) {
            if ( $book->librarian == null)
                $reservations[] = $book;
            else
                $loans[] = $book;
        }

        return view('librarian.display_user', [
            'reservations' => $reservations,
            'loans' => $loans,
            'user' => $user,
        ]);
    }


    public function createLoan(Loan $loan) {

        $loan->isActive = TRUE;
        $loan->librarian()->associate(Auth::user());
        //$book->loans()->save($loan);
        //$user->customerLoans()->save($loan);
        $loan->save();

        return $this->displayUser($loan->customer);
    }
}
