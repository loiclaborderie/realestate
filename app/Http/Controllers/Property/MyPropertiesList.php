<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyPropertiesList extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $properties = Auth::user()->properties()->with('address')->get();
        return Inertia::render('Property/MyPropertiesList', compact(['properties']));
    }
}
