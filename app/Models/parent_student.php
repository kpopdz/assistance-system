<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parent_student extends Model
{
    use HasFactory;
    protected $table="parent_student";

    public $timestamps = false;
}
