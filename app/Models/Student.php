<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Student extends Model
{
    protected $guarded = [];
    use HasUuids;
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classStudents()
    {
        return $this->hasMany(ClassStudent::class);
    }
}
