<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Film::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $film = Film::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'length' => $request->length
        ]);

        return response()->json([
            'status' => (bool)$film,
            'data' => $film,
            'message' => $film ? 'Film Created' : 'Error creating film'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($film)
    {
        $filmWithComments = Film::where('id', 1)->with('reviews')->get();
        return response()->json($filmWithComments);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Film  $film
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Film $film)
    {
        $status = $film->update(
            $request->only(['title', 'description', 'release_year', 'length'])
        );
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Film Updated!' : 'Error Updating Film'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Film $film
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Film $film)
    {
        $status = $film->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Film Deleted!' : 'Error Deleting Film'
        ]);
    }
}
