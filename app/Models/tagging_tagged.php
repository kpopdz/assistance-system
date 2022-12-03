<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagging_tagged extends Model
{
    use HasFactory;


    protected $table="tagging_tagged";

    public $timestamps = false;
}
