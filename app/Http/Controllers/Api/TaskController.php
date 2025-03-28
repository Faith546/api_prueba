<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaskController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['index','show']), //se aplica el middleware auth:api a todas las rutas excepto a las rutas index y show
        ];
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $tasks = Task::all(); //se obtienen todas las tareas
           $tasks = Task::paginate(10); //se obtienen las tareas paginadas
        */

        $tasks = Task::getOrPaginate(); //se obtienen las tareas paginadas acorde al parametro perPage que se envia desde el cliente   
        //return response()->json($tasks);  //se retorna un json con todas las tareas
        return TaskResource::collection($tasks); //se retorna un json con todas las tareas usando el recurso TaskResource
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request) //objeto request se encarga de recibir los datos que se envian desde el cliente
    {
        //ya no se usa porque las validaciones se hicierion en el archivo StoreTaskRequest.php en la carpeta app/Http/Requests
        /* $request->validate([ //se validan los datos que se envian desde el cliente
            'body' => 'required',
            'user_id' => ['required','exists:users,id'],
        ]); */

        $data = $request->all(); //se obtienen todos los datos que se envian desde el cliente
        $data['user_id'] = auth('api')->id(); //se obtiene el id del usuario autenticado y se asigna a la tarea

        $task = Task::create($data); //se crea una nueva tarea con los datos que se envian desde el cliente
        //return response()->json($task, 201); //se retorna un json con la tarea creada y el código 201 que indica que se creo un recurso
        return TaskResource::make($task); //se retorna un json con la tarea creada usando el recurso TaskResource
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //$task = Task::find($task); //se busca la tarea por su id; si se bindea el modelo en la ruta, se puede buscar directamente por el modelo
        //return response()->json($task); //se retorna un json con la tarea encontrada
        return TaskResource::make($task); //se retorna un json con la tarea encontrada usando el recurso TaskResource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
       /*  $request->validate([ //se validan los datos que se envian desde el cliente
            'body' => 'required',
            'user_id' => ['nullable','exists:users,id'],
        ]); */

        //$task = Task::find($task);
        $task->update($request->all()); //se actualiza la tarea con los datos que se envian desde el cliente
       // return response()->json($task); //se retorna un json con la tarea actualizada
        return TaskResource::make($task); //se retorna un json con la tarea actualizada usando el recurso TaskResource
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //$task = Task::find($task); 
        $task->delete(); //se elimina la tarea
        return response()->json(null, 204); //se retorna un json vacio con el código 204 que indica que se elimino un recurso
    }
}
