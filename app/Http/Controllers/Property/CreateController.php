<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Property/Create');
    }
}
