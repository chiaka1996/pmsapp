<?php

namespace App\Scopes;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class FilterByCompanyAndSiteIdScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        /** @var User $user */
        if (Auth::hasUser()) {
            $user = \auth()->user();
            if ($user->hasRole(RoleEnum::PERSONNEL->value)) {
                $builder->where('company_id', $user->company_id);
            }
        }
    }
}
