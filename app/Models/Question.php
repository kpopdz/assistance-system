<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $table="questions";
    protected $fillable = ['question_content', 'question_point'];
    public $timestamps = false;

    /**
     * Get the quiz that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function quiz(): BelongsTo
    // {
    //     return $this->belongsTo(quiz::class, 'quiz_id');
    // }
    public function option(){

        return $this->hasMany(option::class);

    }
    public function correctOptionsCount() {
        return $this->option()->where('iscorrect', 1 )->count();
    }

    public function correctOptions() {
       return  $this->option()->where('iscorrect', 1)->get();
    }
    public function quiz()
    {
        return $this->belongsToMany(quiz::class,'quiz_question','question_id','quiz_id');
    }
}
