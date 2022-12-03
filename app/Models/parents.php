<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class parents extends Model
{
    use HasFactory;
    protected $table = 'parents';

    protected $fillable =['user_id','full_name','phone_number'];
    public $timestamps = false;

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
/**
 * Get all of the comments for the parents
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */

public function students()
{
    return $this->belongsToMany(Student::class,'parent_student','parent_id','student_id')->withPivot('relationship');
}

}
