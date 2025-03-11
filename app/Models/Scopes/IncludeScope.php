<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class IncludeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //incluir relaciones
        if (empty(request('include'))) { //si no se envian relaciones
            return; //se retorna
        }

        $include = explode(',', request('include')); //se obtienen las relaciones que se quieren incluir
        $builder->with($include); //se incluyen las relaciones
    }
}
