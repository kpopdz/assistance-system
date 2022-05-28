<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table="classroom";
    protected $fillable = ['class_id'];
    public $timestamps = false;

    public function users()
{
    return $this->belongsToMany(User::class,'class_user','class_id','user_id');
}
public function quizs()
{
    return $this->belongsToMany(quiz::class,'assignment','class_id','quiz_id');
}


}
