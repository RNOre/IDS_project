<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    use HasFactory;
    protected $guarded = false;
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function indiv_achiv_balls()
    {
        return $this->belongsToMany(IndivAchivBall::class, 'indiv_achiv_ball_scales', 'scale_id', 'indiv_achiv_ball_id');
    }
}
