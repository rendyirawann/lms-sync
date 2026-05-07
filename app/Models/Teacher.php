<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Teacher extends Model
{
    protected $guarded = [];
    use HasUuids;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
