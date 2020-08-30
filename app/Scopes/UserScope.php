<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\User;

class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->whereIn('user_id', function($query) {
            $query->from((new User)->getTable())
                ->select('id')
                ->whereStatus(1);
        });
        //$builder->where('user_id', '=', 1);
    }
}