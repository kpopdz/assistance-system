<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;
    protected $table="student";
    protected $fillable = ['user_id','firstname','lastname','birth_date', 'sex'];

/**
 * Get the user that owns the Student
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
    public function parents()
{
    return $this->belongsToMany(parents::class,'parent_student','student_id','parent_id');
}
}
