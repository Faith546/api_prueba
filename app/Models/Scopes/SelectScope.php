<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SelectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //aplicar selects
        if (empty(request('select'))){ //si no se envía el parametro select
            return; //se retorna
        }

        $select = request('select'); //se obtienen los campos que se quieren seleccionar
        $selectArray = explode(',', $select); //se convierte el string en un array
        $builder->select($selectArray); //se seleccionan los campos
        
    }
}
