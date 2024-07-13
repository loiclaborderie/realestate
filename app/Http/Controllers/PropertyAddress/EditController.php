<?php

namespace App\Http\Controllers\PropertyAddress;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyAddress;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(PropertyAddress $address)
    {
        return Inertia::render('PropertyAddress/Edit', compact(['address']));
    }
}
