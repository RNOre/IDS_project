<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Resources\StudentGroupResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentValuesResource;
use App\Models\IndivAchivBall;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\TypeIndivAchiv;

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

    public function journal()
    {
        $studentsData = $this->service->journalData();
        return $studentsData;
    }

    public function test()
    {
        $studentsData = [];
        $students = Student::all();
        foreach ($students as $student) {
            $studentId = $student->value;
            $studentItem = ['value' => $studentId];

            for ($i = 1; $i <= 3; $i++) {
                $ball = IndivAchivBall::all()->where('student_id', $student->id)->where('type_indiv_achiv_id', $i);
                $type = TypeIndivAchiv::all()->where('id', $i);
                if (($student->averageBall[0]->value == 5) && $i == 1) {
                    $summ = 5;
                } else {
                    $summ = 0;
                }
                $indivAchivItem = [];
                foreach ($ball as $item) {
//                    dd($item->scales[0]->value);
                    if (isset($item->scales[0]->value)) {
//                        dump($item->scales);
                        $summ += $item->scales[0]->value;
                    }
                }

                foreach ($type as $item) {
                    $indivAchivItem = ['name' => $item->name, 'value' => $summ];
                }
                array_push($studentItem, $indivAchivItem);
            }
//            if($student->averageBall[0]->value==5){
//                dump($student->id . ' mark: ' . $student->averageBall[0]->value);
//            }
            array_push($studentsData, $studentItem);
        }
//        die;
        return $studentsData;
    }

//        for ($i = 1; $i <= 3; $i++) {
//            $ball = IndivAchivBall::all()->where('student_id', 1)->where('type_indiv_achiv_id', $i);
//            $summ = 0;
//            $type = TypeIndivAchiv::all()->where('id', $i);
//            foreach ($type as $item) {
//                dump($item->name);
//            }
//            foreach ($ball as $item) {
//                $summ += $item->value;
//            }
//            dump($summ);
//        }
        public function studentsValue()
        {
            return StudentValuesResource::collection(Student::all());
        }

}
