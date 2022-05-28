<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parents extends Model
{
    use HasFactory;
    protected $table = 'parents';

    public $timestamps = false;

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
public function students()
{
    return $this->belongsToMany(Student::class,'parent_student','parent_id','student_id');
}
}
