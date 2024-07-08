<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return "index access";
    }
}
