<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PropertyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'state',
        'street',
        'zip',
        'unit_number',
        'latitude',
        'longitude'
    ];

    public function property() : HasOne
    {
        return $this->HasOne(Property::class);
    }
}
