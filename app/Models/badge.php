<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class badge extends Model
{
    use HasFactory;
    protected $table="badge";

    public $timestamps = false;
    public function student(): BelongsTo
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }

}
