<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($film)
    {
        return response()->json(Review::where('film_id', $film)->get()->toArray());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $film)
    {
        $review = Review::create([
            'film_id' => $film,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'status' => (bool)$review,
            'data' => $review,
            'message' => $review ? 'Inventory Created' : 'Error creating inventory'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($review)
    {
        $reviewToDelete = Review::where('id', $review);
        $status = $reviewToDelete->delete();
        return response()->json([
            'status' => $status,
            'message' => $status ? 'Review Deleted!' : 'Error Deleting Review'
        ]);
    }
}
