<?php

namespace App\Http\Controllers\Property;

use App\Actions\CreatePropertyAddressAction;
use App\DTOs\PropertyAddressData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyStoreRequest;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function __invoke(PropertyStoreRequest $request, CreatePropertyAddressAction $action)
    {
        $addressData = PropertyAddressData::fromArray($request->validated());
        try {
            $propertyAddress = $action->execute($addressData);
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
        $propertyData = $request->only([
            'name',
            'price',
            'bedroom',
            'bathroom',
            'floor',
            'building_area',
            'land_area',
            'sold_at'
        ]);

        // TODO: Add picture upload as well

        Auth::user()->properties()->create([
            'property_address_id' => $propertyAddress->id,
            'property_type_id' => PropertyType::firstWhere('name', $request['type'])->id,
            ...$propertyData
        ]);
        return Inertia::render('Property/MyPropertiesList');

    }
}
