<?php

namespace App\Http\Controllers;

use App\Models\UserPokemonFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPokemonFavoriteController extends Controller
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
        $user = UserPokemonFavorite::updateOrCreate(
                [
                    'userId'    => Auth::user()->id
                ], 
                [
                    'pokemonId'  => $request->pokemonId,
                ]
            );

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function show(UserPokemonFavorite $userPokemonFavorite)
    {
        $res = UserPokemonFavorite::where('userId', Auth::user()->id)->get()->toJson();

        return response($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPokemonFavorite $userPokemonFavorite)
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
    public function update(Request $request, UserPokemonFavorite $userPokemonFavorite)
    {
        UserPokemonFavorite::where(['userId'=>Auth::user()->id, 'pokemonId'=>$request->pokemonId])->first()->delete();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPokemonFavorite  $userPokemonFavorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPokemonFavorite $userPokemonFavorite)
    {
        //
    }
}
