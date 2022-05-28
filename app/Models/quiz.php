<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class quiz extends Model
{
    use \Conner\Tagging\Taggable;
    use Searchable;
    protected $table="quiz";
    protected $fillable = ['title','description','image', 'start_date', 'duration','chapter','tags','publish','visibility','dead_line'];

    public $timestamps= false;
    /**
     * Get the user that owns the quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'other_key');
    }
    // public function question(){

    //     return $this->hasMany(question::class);

    // }
    public function didYouPassQuiz($id)
    {
        $coll =$this->result()->find($id);
        if ($coll) {
            return true;
           }else {
               return false;
           }
        # code...
    }

    public function result(){

        return $this->hasMany(Result::class);

    }
    public function question()
{
    return $this->belongsToMany(question::class,'quiz_question','quiz_id','question_id');
}
    public function totalPoint()
    {
        return $this->question()->sum('question_point');
    }
    public function userpassesquiz()
    {
        return $this->result()->count();
    }

    public function toSearchableArray()

    {

        return [

            'title' => $this->title,

        ];

    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class,'assignment','quiz_id','class_id');
    }
    public function collections()
    {
        return $this->belongsToMany(collection::class,'collection_quiz','quiz_id','collection_id');
    }
    public function isFavorate($id)
    {
       $coll =$this->collections()->find($id);
       if ($coll) {
        return true;
       }else {
           return 0;
       }
        # code...
    }
}
