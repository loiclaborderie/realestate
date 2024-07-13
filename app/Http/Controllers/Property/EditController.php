<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Property $property)
    {
        return Inertia::render('Property/Edit');
    }
}
