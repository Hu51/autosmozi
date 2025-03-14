<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Schedule",
 *     required={"date", "time", "available_seats", "movie_id"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="date", type="string", format="date"),
 *     @OA\Property(property="time", type="string", format="time"),
 *     @OA\Property(property="available_seats", type="integer", minimum=0),
 *     @OA\Property(property="movie_id", type="integer"),
 *     @OA\Property(
 *         property="movie",
 *         ref="#/components/schemas/Movie"
 *     )
 * )
 */
class Schedule extends Model
{
    protected $table = 'schedules';
    public $timestamps = false;    

    protected $fillable = [
        'date',
        'time',
        'available_seats',
        'movie_id'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
