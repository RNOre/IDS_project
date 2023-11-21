<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartificationFact extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function event()
    {
        return $this->hasMany(Event::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
