<?php

namespace App\Http\Controllers\StudentGroup;

use App\Services\Group\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
