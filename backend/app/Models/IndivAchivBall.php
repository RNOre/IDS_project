<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndivAchivBall extends Model
{
    protected $guarded = false;
    public function scales()
    {
        return $this->belongsToMany(Scale::class, 'indiv_achiv_ball_scales', 'indiv_achiv_ball_id', 'scale_id');
    }
    public function typeIndivAchiv()
    {
        return $this->belongsTo(TypeIndivAchiv::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
