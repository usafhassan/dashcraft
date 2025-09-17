<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users can view customers
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Customer $customer): bool
    {
        // All authenticated users can view individual customers
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only admins and managers can create customers
        return $user->hasRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Customer $customer): bool
    {
        // Only admins and managers can update customers
        return $user->hasRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Customer $customer): bool
    {
        // Only admins can delete customers
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Customer $customer): bool
    {
        // Only admins can restore customers
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Customer $customer): bool
    {
        // Only admins can permanently delete customers
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can bulk delete customers.
     */
    public function deleteAny(User $user): bool
    {
        // Only admins can bulk delete customers
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can export customers.
     */
    public function export(User $user): bool
    {
        // Admins and managers can export customers
        return $user->hasRole(['admin', 'manager']);
    }

    /**
     * Determine whether the user can import customers.
     */
    public function import(User $user): bool
    {
        // Only admins can import customers
        return $user->hasRole('admin');
    }
}