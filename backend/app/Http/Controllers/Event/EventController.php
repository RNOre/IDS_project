<?php

namespace App\Http\Controllers\Event;

use App\Models\StudentGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events= $this->service->indexEvent();
        return $events;
    }

    public function journal()
    {
        $eventsData = $this->service->journalData();
        return $eventsData;
    }
}
