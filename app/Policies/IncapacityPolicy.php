<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Incapacity;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncapacityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_incapacity');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Incapacity $incapacity): bool
    {
        return $user->can('view_incapacity');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_incapacity');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Incapacity $incapacity): bool
    {
        return $user->can('update_incapacity');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Incapacity $incapacity): bool
    {
        return $user->can('delete_incapacity');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_incapacity');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Incapacity $incapacity): bool
    {
        return $user->can('force_delete_incapacity');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_incapacity');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Incapacity $incapacity): bool
    {
        return $user->can('restore_incapacity');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_incapacity');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Incapacity $incapacity): bool
    {
        return $user->can('replicate_incapacity');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_incapacity');
    }
}
