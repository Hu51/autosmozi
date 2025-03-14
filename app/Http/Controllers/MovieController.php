<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 *     name="Movies",
 *     description="API Endpoints for managing movies"
 * )
 */
class MovieController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/movies",
     *     summary="List all movies",
     *     tags={"Movies"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all movies",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Movie"))
     *     )
     * )
     */
    public function index()
    {
        $movies = Movie::all();
        return response()->json($movies);
    }

    /**
     * @OA\Post(
     *     path="/api/movies",
     *     summary="Create a new movie",
     *     tags={"Movies"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description","age_rating","language","cover_image"},
     *             @OA\Property(property="title", type="string", maxLength=100),
     *             @OA\Property(property="description", type="string", maxLength=255),
     *             @OA\Property(property="age_rating", type="string", maxLength=10),
     *             @OA\Property(property="language", type="string", maxLength=2),
     *             @OA\Property(property="cover_image", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'age_rating' => 'required|string|max:10',
            'language' => 'required|string|max:2',
            'cover_image' => 'required|string',
        ]);

        $movie = Movie::create($validated);
        return response()->json($movie, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/movies/{id}",
     *     summary="Get a specific movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Movie ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie details",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function show(Movie $movie)
    {
        return response()->json($movie);
    }

    /**
     * @OA\Put(
     *     path="/api/movies/{id}",
     *     summary="Update a movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Movie ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", maxLength=100),
     *             @OA\Property(property="description", type="string", maxLength=255),
     *             @OA\Property(property="age_rating", type="string", maxLength=10),
     *             @OA\Property(property="language", type="string", maxLength=2),
     *             @OA\Property(property="cover_image", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:100',
            'description' => 'sometimes|string|max:255',
            'age_rating' => 'sometimes|string|max:10',
            'language' => 'sometimes|string|max:2',
            'cover_image' => 'sometimes|string',
        ]);

        $movie->update($validated);
        return response()->json($movie);
    }

    /**
     * @OA\Delete(
     *     path="/api/movies/{id}",
     *     summary="Delete a movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Movie ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Movie deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
} 