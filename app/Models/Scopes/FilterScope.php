<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void //la consulta se recupera en $builder
    {
        //Aplicar filtros
        if (empty(request('filters'))){
            return;
        }

        $filters = request ('filters'); //se obtienen los filtros que se envian desde el cliente

        foreach ($filters as $field => $conditions){ //se recorren los filtros
            foreach ($conditions as $operator => $value){ //se recorren las condiciones

                if (in_array($operator, ['=', '<', '>', '<=', '>=', '!='])){ //se verifica si el operador es igual a alguno de los operadores permitidos
                    $builder->where($field, $operator, $value); //se aplican los filtros
                } 

                if ($operator == 'like'){ //se verifica si el operador es igual a like
                    $builder->where($field, 'like', "%$value%"); //se aplican los filtros
                }
                
            }
        }
    }
}
