<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //metodo guardar
    public function store(Request $request)
    {
            try {
                $data['title'] = $request['title'];
                $data['course'] = $request['course'];
                $data['description'] = $request['description'];
                $data['completed'] = $request['completed'];
                $data['horario'] = $request['horario'];
                $res = Task::create($data);
                return response()->json( $res, 200);
            } catch (\Throwable $th) {
                return response()->json([ 'error' => $th->getMessage()], 500);
            }
    }    

    //Metodo Actualizar
    public function update(Request $request,$id)
    {
        try {
            $data['title'] = $request['title'];
            $data['course'] = $request['course'];
            $data['description'] = $request['description'];
            $data['completed'] = $request['completed'];
            $data['horario'] = $request['horario'];
            Task::find($id)->update($data);
            $res = Task::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Task::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
        //Buscando Obj
        $tarea=Task::findOrfail($request->id); 
        if($tarea){
            return ['tarea'=>$tarea];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll()
    {
        try {
            $data = Task::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}