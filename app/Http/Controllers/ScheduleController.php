<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Schedules",
 *     description="API Endpoints for managing movie schedules"
 * )
 */
class ScheduleController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/schedules",
     *     summary="List all schedules",
     *     tags={"Schedules"},
     *     @OA\Response(
     *         response=200,
     *         description="List of all schedules",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Schedule"))
     *     )
     * )
     */
    public function index()
    {
        $schedules = Schedule::with('movie')->get();
        return response()->json($schedules);
    }

    /**
     * @OA\Post(
     *     path="/api/schedules",
     *     summary="Create a new schedule",
     *     tags={"Schedules"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"date","time","available_seats","movie_id"},
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="time", type="string", format="time"),
     *             @OA\Property(property="available_seats", type="integer", minimum=0),
     *             @OA\Property(property="movie_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Schedule created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Schedule")
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
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'available_seats' => 'required|integer|min:0',
            'movie_id' => 'required|exists:movie,id'
        ]);

        $schedule = Schedule::create($validated);
        return response()->json($schedule, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/schedules/{id}",
     *     summary="Get a specific schedule",
     *     tags={"Schedules"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Schedule ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Schedule details",
     *         @OA\JsonContent(ref="#/components/schemas/Schedule")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Schedule not found"
     *     )
     * )
     */
    public function show(Schedule $schedule)
    {
        return response()->json($schedule->load('movie'));
    }

    /**
     * @OA\Put(
     *     path="/api/schedules/{id}",
     *     summary="Update a schedule",
     *     tags={"Schedules"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Schedule ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="date", type="string", format="date"),
     *             @OA\Property(property="time", type="string", format="time"),
     *             @OA\Property(property="available_seats", type="integer", minimum=0),
     *             @OA\Property(property="movie_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Schedule updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Schedule")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Schedule not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'date' => 'sometimes|date',
            'time' => 'sometimes|date_format:H:i',
            'available_seats' => 'sometimes|integer|min:0',
            'movie_id' => 'sometimes|exists:movie,id'
        ]);

        $schedule->update($validated);
        return response()->json($schedule);
    }

    /**
     * @OA\Delete(
     *     path="/api/schedules/{id}",
     *     summary="Delete a schedule",
     *     tags={"Schedules"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Schedule ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Schedule deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Schedule not found"
     *     )
     * )
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(null, 204);
    }
} 