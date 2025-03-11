<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //aplicar orden
        if (empty(request('sort'))){ //si no se envía el parametro sort
            return; //se retorna
        }
            
        $sortFields = explode(',', request('sort')); //se obtienen los campos por los que se quiere ordenar
        foreach ($sortFields as $sortField){ //se recorren los campos

            $direction = 'asc'; //se inicializa la variable direction

            if (substr($sortField, 0, 1) == '-'){ //se verifica si el campo empieza con un guion
                $direction = 'desc'; //se cambia la variable direction a desc
                $sortField = substr($sortField, 1); //se elimina el guion del campo
            }

            $builder->orderBy($sortField, $direction); //se ordenan las tareas
        }
    }
}

