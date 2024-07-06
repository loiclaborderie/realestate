<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'url',
        'title',
        'description',
        'is_primary',
        'display_order'
    ];

    public function property() :BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
