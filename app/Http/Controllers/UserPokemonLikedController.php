<?php

namespace App\Http\Controllers;

use App\Models\UserPokemonLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPokemonLikedController extends Controller
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
        $countPokemon = UserPokemonLiked::where('userId',Auth::user()->id)->count();
        if($countPokemon < 3){
            $res = UserPokemonLiked::updateOrCreate(
                [
                    'userId'    => Auth::user()->id,
                    'pokemonId'  => $request->pokemonId,
                ]
            );
        }

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPokemonLiked  $userPokemonLiked
     * @return \Illuminate\Http\Response
     */
    public function show(UserPokemonLiked $userPokemonLiked)
    {
        $res = UserPokemonLiked::where('userId', Auth::user()->id)->get()->toJson();

        return response($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPokemonLiked  $userPokemonLiked
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPokemonLiked $userPokemonLiked)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPokemonLiked  $userPokemonLiked
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPokemonLiked $userPokemonLiked)
    {
        UserPokemonLiked::where(['userId'=>Auth::user()->id, 'pokemonId'=>$request->pokemonId])->first()->delete();
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPokemonLiked  $userPokemonLiked
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPokemonLiked $userPokemonLiked)
    {
        //
    }
}
