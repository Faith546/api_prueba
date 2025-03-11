<?php

namespace App\Models;

use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class Task extends Api
{
    use HasFactory;

    //protected $table = 'tasks'; // Nombre de la tabla en la BD, si no se especifica se asume el nombre de la clase en plural en inglés

    /* protected $fillable = [
        'body',
        'user_id'
    ]; //campos que se pueden asignar masivamente */

    protected $guarded = []; //campos que no se pueden asignar masivamente

    public function user() //relación uno a muchos inversa
    {
        return $this->belongsTo(User::class); //una tarea pertenece a un usuario
    }
}
