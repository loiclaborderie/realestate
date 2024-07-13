<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        // TODO: Add more query params for filtrers, search etc
        $lat = $request->input('lat', null);
        $long = $request->input('long', null);
        $query = Property::with('address');
        if(!is_null($lat) && !is_null($long)){
            $query->withDistance($long, $lat);
        }
        $data = $query->paginate(10);

        return Inertia::render('Property/Index', [
            'properties'=> $data->items()
        ]);
    }
}
