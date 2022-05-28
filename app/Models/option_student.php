<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class option_student extends Model
{
    use HasFactory;
    protected $table="option_student";
    protected $fillable = ['student_id', 'option_id'];
    public $timestamps = false;



}
