<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPractice extends Model
{
    protected $fillable = ['user_id', 'practice_date', 'start_time', 'end_time', 'area', 'hours', 'activities', 'observations'];
    protected $casts    = ['practice_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}