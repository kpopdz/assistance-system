<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    public function quiz(){
        return $this->belongsTo(quiz::class);
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function options() {
        return $this->hasMany(UserOption::class, 'result_id', 'id');
    }
}
