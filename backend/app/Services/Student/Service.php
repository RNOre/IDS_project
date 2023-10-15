<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\StudentGroupRegistration;
use Illuminate\Support\Facades\DB;

class Service
{
    public function index()
    {
    }

    public function show($student)
    {

        $balls = [];
        $groups = [];

        foreach ($student->studentGroupRegistration as $groupRegistration) {
            $groupItem = ['name' => $groupRegistration->studentGroup->name, 'EI' => $groupRegistration->studentGroup->educInst->name,
                'ed' => $groupRegistration->enrollmentDate, 'dd' => $groupRegistration->deductionDate];
            array_push($groups, $groupItem);
        }

        foreach ($student->indivAchivBall as $indivAchivBall) {
            $ballItem = ['value' => $indivAchivBall->value, 'date' => $indivAchivBall->date,
                'type' => $indivAchivBall->typeIndivAchiv->name];
            array_push($balls, $ballItem);
        }

        $response = ['value' => $student->value, 'groups' => $groups, 'balls' => $balls];

        return $response;
    }

    public function store($data)
    {
        $studentData = ['value' => $data['value']];
        $studentId = Student::create($studentData)->id;

        unset($data['value']);
        $groupRegistration = ['student_id' => $studentId];
        $groupRegistration = array_merge($data, $groupRegistration);
        $student = StudentGroupRegistration::create($groupRegistration);

        return $student;
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
    }
}
