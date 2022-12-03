<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['firstname','lastname','birth_date', 'sex', 'address','grade','marital_situation: ','user_id'];
    public $timestamps = false;

    /**
     * Get the user that owns the Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function classteacher()
{
    return $this->belongsToMany(Classroom::class,'class_teacher','teacher_id','class_id');
}
}
