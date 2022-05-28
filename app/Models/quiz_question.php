<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz_question extends Model
{
    use HasFactory;
    protected $table="quiz_question";
    public function quiz(){
        return $this->belongsTo(quiz::class);
    }
    public $timestamps = false;
}
