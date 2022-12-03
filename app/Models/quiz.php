<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasMany;

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
    /**
     * Get all of the assignment for the quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(assignment::class, 'quiz_id', 'id');
    }

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
    public function resultavg(){

        return $this->result()
        ->selectRaw('quiz_id, avg(fullpoint) as aggregate')
        ->groupBy('quiz_id');

    }

    public function getAvgRatingAttribute()
{
    if ( ! array_key_exists('resultavg', $this->relations)) {
       $this->load('resultavg');
    }

    $relation = $this->getRelation('resultavg')->first();

    return ($relation) ? $relation->aggregate : null;
}
    public function question()
{
    return $this->belongsToMany(question::class,'quiz_question','quiz_id','question_id');
}

public function questionsumpoint()
{
  return $this->question()
    ->selectRaw('quiz_id, sum(question_point) as aggregate')
    ->groupBy('quiz_id');
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
    public function courses()
    {
        return $this->belongsToMany(course::class,'quiz_id','course_id');
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
