<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class collection extends Model
{
    use HasFactory;
    public function quizs()
{
    return $this->belongsToMany(quiz::class,'collection_quiz','collection_id','quiz_id');
}
use HasFactory;
/**
 * Get the user that owns the collection
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}
