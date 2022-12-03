<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;
use Laravel\Scout\Searchable;



class Student extends Model
{
    use Searchable;

    use HasFactory;
    protected $table="student";
    protected $fillable = ['user_id','student_id','firstname','lastname','birth_date','sex','nationality','address'];
    public $timestamps = false;

    public function toSearchableArray()

    {

        return [


'firstname'=>$this->firstname,
'lastname'=>$this->lastname,
        ];

    }
/**
 * Get the user that owns the Student
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
public function datebirth()
{
  return  $this->birth_date;
}
/**
 * Get the user that owns the Student
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function academic_levelname(): BelongsTo
{
    return $this->belongsTo(academic_level::class, 'academic_level', 'id');
}
/**
 * Get the user associated with the Student
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function points(): HasOne
{
    return $this->hasOne(point::class, 'student_id', 'id');
}

public function Age()
{
  $birth=  Carbon::parse($this->datebirth());

  return $birth->age;

}
public function badge(): HasOne
{
    return $this->hasOne(badge::class, 'student_id', 'id');
}
    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
    public function parents()
{
    return $this->belongsToMany(parents::class,'parent_student','student_id','parent_id');
}
}
