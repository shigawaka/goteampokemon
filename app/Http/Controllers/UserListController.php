<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        $res = User::with('favorite', 'like', 'hate')->where('id', '!=', Auth::user()->id)->get()->toJson();

        return response($res);
    }

    /**
     * Display the other user profiles view.
     *
     * @return \Inertia\Response
     */
    public function showUsersList()
    {
        return Inertia::render('Auth/UsersList');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //
    }
}
