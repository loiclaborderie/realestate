<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PropertyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view-properties');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Property $property): bool
    {
        return $user->hasPermissionTo('view-property-details');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create-property');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Property $property): bool
    {
        return $user->hasPermissionTo('edit-own-property') && $property->owner()->is(Auth::user());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Property $property): bool
    {
        return $user->hasPermissionTo('delete-own-property') && $property->owner()->is(Auth::user());
    }
}
