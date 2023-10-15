<?php

namespace App\Http\Controllers\StudentGroup;

use App\Http\Resources\StudentGroupResource;
use App\Models\StudentGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    public function index()
    {
        return StudentGroupResource::collection(StudentGroup::all());
    }
    public function store()
    {

    }

}
