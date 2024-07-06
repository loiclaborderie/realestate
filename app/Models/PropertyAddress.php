<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'street',
        'zip',
        'unit_number',
        'latitude',
        'longitude'
    ];

    public function property() : BelongsTo
    {
        return $this->BelongsTo(Property::class);
    }
}
