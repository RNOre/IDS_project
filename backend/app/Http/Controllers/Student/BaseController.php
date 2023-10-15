<?php

namespace App\Http\Controllers\Student;

use Illuminate\Routing\Controller;
use App\Services\Student\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
