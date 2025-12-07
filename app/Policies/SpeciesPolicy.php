<?php

namespace App\Policies;

use App\Models\Species;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Http\Controllers\PermissionController;

class SpeciesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return PermissionController::isAuthorized('species.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Species $species): bool
    {
        return PermissionController::isAuthorized('species.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return PermissionController::isAuthorized('species.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Species $species): bool
    {
        return PermissionController::isAuthorized('species.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Species $species): bool
    {
        return PermissionController::isAuthorized('species.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Species $species): bool
    {
        return PermissionController::isAuthorized('species.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Species $species): bool
    {
        return PermissionController::isAuthorized('species.delete');
    }
}