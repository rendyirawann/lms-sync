<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Assignment extends Model
{
    protected $guarded = [];
    use HasUuids;
    
    public function teachingAssignment()
    {
        return $this->belongsTo(TeachingAssignment::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
