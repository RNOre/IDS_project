<?php

namespace App\Http\Controllers;

use App\Models\AverageBall;
use App\Models\IndivAchivBall;
use App\Models\Scale;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function index()
    {
//        $test=IndivAchivBall::all()->where('student_id',1);
//        $test = $test->scales;
//        return $test;
        $scale = Scale::all();
        return $scale;
    }
}
