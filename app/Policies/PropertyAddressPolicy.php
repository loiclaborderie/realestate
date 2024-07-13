<?php

namespace App\Policies;

use App\Models\PropertyAddress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PropertyAddressPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PropertyAddress $propertyAddress): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PropertyAddress $address): bool
    {
        return $user->hasPermissionTo('edit-own-property') && $address->property->owner()->is(Auth::user());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PropertyAddress $propertyAddress): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PropertyAddress $propertyAddress): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PropertyAddress $propertyAddress): bool
    {
        return true;
    }
}
