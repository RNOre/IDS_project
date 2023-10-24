<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;

class StudentController extends BaseController
{
    public function index()
    {
        return StudentResource::collection(Student::all());
    }

    public function show(Student $student)
    {
        $student = $this->service->show($student);

        return response()->json($student);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $student = $this->service->store($data);

        return response()->json($student->id, status: 201);
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return response(200);
    }

    public function test()
    {
        dd($this->service->test());
    }
}
