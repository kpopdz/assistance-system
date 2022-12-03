<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'role',
    ];
    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(course::class);
    }
/**
 * Get all of the comments for the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function quizs(): HasMany
{
    return $this->hasMany(quiz::class);
}
/**
 * Get the user associated with the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function teacher(): HasOne
{
    return $this->hasOne(teacher::class, 'user_id', 'id');
}
public function admin(): HasOne
{
    return $this->hasOne(admin::class, 'user_id', 'id');
}
public function student(): HasOne
{
    return $this->hasOne(Student::class, 'user_id', 'id');
}
public function results() {
    return $this->hasMany('App\Result', 'user_id', 'id');
}
public function collections()
{
    return $this->hasMany(collection::class, 'user_id', 'id');
}
/**
 * Get all of the comments for the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */

public function quizCount() {
    return $this->results()->count();
}

public function classes()
{
    return $this->belongsToMany(Classroom::class,'class_user','user_id','class_id');
}
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
  /*  protected $hidden = [
        'password',
        'remember_token',
    ];*/

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
   /* protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
