<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ClassRoom extends Model
{
    protected $guarded = [];
    use HasUuids;
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
