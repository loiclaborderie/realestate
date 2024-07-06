<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bedroom',
        'bathroom',
        'floor',
        'building_area',
        'land_area',
        'sold_at',
        'property_address_id'
    ];
    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function address() : HasOne
    {
        return $this->HasOne(PropertyAddress::class);
    }
}
