<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Database\Eloquent\Concerns\HasUuids;

    protected $fillable = [
        'teaching_assignment_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'is_published'
    ];

    public function teachingAssignment()
    {
        return $this->belongsTo(TeachingAssignment::class);
    }
}
