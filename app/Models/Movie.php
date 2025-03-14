<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Movie",
 *     required={"title", "description", "age_rating", "language", "cover_image"},
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="title", type="string", maxLength=100),
 *     @OA\Property(property="description", type="string", maxLength=255),
 *     @OA\Property(property="age_rating", type="string", maxLength=10),
 *     @OA\Property(property="language", type="string", maxLength=2),
 *     @OA\Property(property="cover_image", type="string")
 * )
 */
class Movie extends Model
{
    protected $table = 'movies';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'age_rating',
        'language',
        'cover_image'
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
