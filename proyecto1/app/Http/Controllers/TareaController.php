<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{

    public function store(Request $request)  //para crear uno nuevo
    {
        try{
            $data['Nombre'] = $request['Nombre'];
            $data['Descripcion'] = $request['Descripcion'];
            $data['Estado'] = $request['Estado'];
            $res = Tarea::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }   
    } 
    
    public function update(Request $request,$id)  //Funcion para actualizar
    {
        try{
            $data['id'] = $request['id'];    //faltaba el id
            $data['Nombre'] = $request['Nombre'];
            $data['Descripcion'] = $request['Descripcion'];
            $data['Estado'] = $request['Estado'];
            Tarea::find($id)->update($data);
            $res = Tarea::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Tarea::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
       
        $data=Tarea::findOrfail($request->id); 
        if($data){
            return ['tarea'=>$data];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll() //Mostrar todos 
    {
        try {
            $data = Tarea::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //metodo desactivar tarea
    public function deactivate(Request $request){
        //Buscando el objeto que ya existe
        $data = Tarea::findOrfail($request->id);
        $data->Estado = 'PENDIENTE';
        $data->save();
    }

    //metodo desactivar post
    public function activate(Request $request){
        //Buscando el objeto que ya existe
        $data = Tarea::findOrfail($request->id);
        $data->Estado = 'COMPLETADO';
        $data->save();
    }
}