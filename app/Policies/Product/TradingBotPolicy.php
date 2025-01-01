<?php

namespace App\Policies\Product;

use App\Models\User;
use App\Models\Product\TradingBot;
use Illuminate\Auth\Access\HandlesAuthorization;

class TradingBotPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_trading::bot');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('view_trading::bot');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_trading::bot');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('update_trading::bot');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('delete_trading::bot');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_trading::bot');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('force_delete_trading::bot');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_trading::bot');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('restore_trading::bot');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_trading::bot');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, TradingBot $tradingBot): bool
    {
        return $user->can('replicate_trading::bot');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_trading::bot');
    }
}
