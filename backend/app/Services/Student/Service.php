<?php

namespace App\Services\Student;

use App\Models\AverageBall;
use App\Models\Event;
use App\Models\Student;
use App\Models\StudentGroupRegistration;
use Illuminate\Support\Facades\DB;

class Service
{
    public function indexEvent()
    {
        $events = Event::all();
        return $events;
    }

    public function journalData()
    {
        $events = [];
        $journalData = Event::all();
        foreach ($journalData as $eventData) {
//            dump($eventData->name);
            $eventsItem=['name'=>$eventData->name, 'id'=>$eventData->id, 'studentList'=>[]];
            array_push($events, $eventsItem);
            $students = $eventData->partificationFact;
            foreach ($students as $item) {
                $studentList=['value'=>$item->student->value];
                array_push($events[count($events)-1]['studentList'], $studentList);
//                dump($item->student->value);
            }
        }
        return $events;
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
//        $groups=['name' => $student->studentGroup->name, 'EI' => $student->studentGroup->educInst->name,
//            'ed' => $student->enrollmentDate, 'dd' => $student->deductionDate];

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
        //TODO: передача averageBall
        dd($data);
        $studentData = ['value' => $data['value']];
        $studentId = Student::create($studentData)->id;

        unset($data['value']);
        $groupRegistration = ['student_id' => $studentId];
        $groupRegistration = array_merge($data, $groupRegistration);
        $student = StudentGroupRegistration::create($groupRegistration);
        $averageBall = ['date' => '2001-09-11', 'value' => $data->averageBall, 'student_id' => $studentId];
        AverageBall::create($averageBall);
        return $student;
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
    }

    public function test()
    {
        $student = Student::all();
//        foreach ($student->)
        return $student;
    }
}
