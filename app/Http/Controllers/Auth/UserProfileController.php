<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;


class UserProfileController extends Controller
{
    /**
     * Display the user profile view.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return Inertia::render('Auth/Profile');
    }

    /**
     * Handle an incoming profile update request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/',
            'lastName' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/',
            'date_of_birth' => 'required|date|before:'.now()->subYears(18)->toDateString(),
        ]);

        // Need to modify since datepicker returns String and column type needs to be a date format
        $time = strtotime($request->date_of_birth);
        $newformat = date('Y-m-d',$time);

        $user = User::find(Auth::user()->id)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'date_of_birth' => $newformat,
        ]);

        return redirect('/profile');
    }

}
