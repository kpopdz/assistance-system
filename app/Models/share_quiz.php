<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class share_quiz extends Model
{
    use HasFactory;
    protected $table="share_quiz";
    public $timestamps = false;
    public function quiz(){
        return $this->belongsTo(quiz::class,'quiz_id','id');
    }

}
