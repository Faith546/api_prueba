<?php

namespace App\Models;

use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    //scopes globales
    protected static function booted(): void
    {
        static::addGlobalScopes([
            FilterScope::class,
            SelectScope::class,
            SortScope::class,
            IncludeScope::class
        ]);
    }

    //scope local
    public function scopeGetOrPaginate($query) //$query es el objeto que se pasa por defecto al scope
    {
        //Crear paginación
        if (request('perPage')){
            return $query->paginate(request('perPage')); //se obtienen las tareas paginadas acorde al parametro perPage que se envia desde el cliente
        } 

        return $query->get(); //se obtienen todas las tareas
    }
}
