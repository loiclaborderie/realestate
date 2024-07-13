<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'property_address_id',
        'property_type_id',
        'user_id'
    ];
    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function address() : BelongsTo
    {
        return $this->BelongsTo(PropertyAddress::class, 'property_address_id');
    }

    public function pictures() : HasMany
    {
        return $this->hasMany(PropertyPicture::class);
    }

    public function scopeWithDistance(Builder $query, float $long, float $lat): Builder
    {
        return $query->select('properties.*')
            ->selectRaw('( 6371 * acos( cos( radians(?) )
             * cos( radians( property_addresses.latitude ) )
             * cos( radians( property_addresses.longitude ) - radians(?) )
             + sin( radians(?) ) * sin( radians( property_addresses.latitude )
              ) ) ) AS distance', [$lat, $long, $lat])
            ->join('property_addresses', 'properties.property_address_id', '=', 'property_addresses.id')
            ->orderBy('distance');
    }
}
