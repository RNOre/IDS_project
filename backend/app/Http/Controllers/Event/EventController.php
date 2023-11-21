<?php

namespace App\Http\Controllers\Event;

use App\Http\Resources\StudentValuesResource;
use App\Models\EducInst;
use App\Models\Event;
use App\Models\Indiv_achiv_ballScale;
use App\Models\IndivAchivBall;
use App\Models\Level;
use App\Models\PartificationFact;
use App\Models\Scale;
use App\Models\StudentGroup;
use App\Http\Controllers\Controller;
use App\Models\TypeIndivAchiv;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = $this->service->indexEvent();
        return $events;
    }

    public function journal()
    {
        $eventsData = $this->service->journalData();
        return $eventsData;
    }

    public function levels()
    {
        return Level::select('name', 'id')->get();
    }

    public function eventType()
    {
        return TypeIndivAchiv::select('name', 'id')->get();
    }

    public function educInst()
    {
        return EducInst::select('name', 'id')->get();
    }

    public function create(Request $request)
    {
        $event = ['name' => $request->post("name"), 'educ_inst_id' => $request->post("educ_inst_id"),
            'level_id' => $request->post("level_id")];
//        dd($event);
        return Event::create($event);

    }

    public function participant(Request $request)
    {
        $partification_fact=["date"=>$request->post("date"),
            "category"=>$request->post("category"),
            "event_id"=>$request->post("event_id"),
            "student_id"=>$request->post("student_id"),
            ];
        PartificationFact::create($partification_fact);
        $indiv_achiv_ball=[
            "date"=>$request->post("date"),
            "student_id"=>$request->post("student_id"),
            "type_indiv_achiv_id"=>$request->post("type_indiv_achiv_id"),
        ];
        $indiv_achiv_id= IndivAchivBall::create($indiv_achiv_ball)->id;
        $scale_indiv_ball=[
            "indiv_achiv_ball_id"=>$indiv_achiv_id,
            "scale_id"=>$request->post("scale_id")
        ];
        Indiv_achiv_ballScale::create($scale_indiv_ball);
        return 'success';
    }

    public function scales()
    {
        return StudentValuesResource::collection(Scale::all()) ;
    }
}
