<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyUpdateRequest;
use App\Models\Property;
use Inertia\Inertia;

class UpdateController extends Controller
{
    public function __invoke(Property $property, PropertyUpdateRequest $request)
    {
        $property->update($request->validated());
        return Inertia::render('Property/MyPropertiesList');
    }
}
