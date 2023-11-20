<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    //metodo guardar/crear
    public function store(Request $request)
    {
            try {
                $data['Nombre'] = $request['Nombre'];
                $data['Apellido'] = $request['Apellido'];
                $data['Semestre'] = $request['Semestre'];
                $res = Inscripcion::create($data);
                return response()->json( $res, 200);
            } catch (\Throwable $th) {
                return response()->json([ 'error' => $th->getMessage()], 500);
            }         
    }    

    //Metodo Actualizar
    public function update(Request $request,$id)
    {
        try {
            $data['id'] = $request['id']; 
            $data['Nombre'] = $request['Nombre'];
            $data['Apellido'] = $request['Apellido'];
            $data['Semestre'] = $request['Semestre'];
            Inscripcion::find($id)->update($data);
            $res = Inscripcion::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
        //metodo desactivar inscripcion
    public function deactivate(Request $request,$id){
        //Buscando el objeto que ya existe
        $data = Inscripcion::findOrfail($request->id);
        $data->semestre = 'PENDIENTE';
        $data->save();
    }

    //metodo activar inscripcion
    public function activate(Request $request){
        //Buscando el objeto que ya existe
        $data = Inscripcion::findOrfail($request->id);
        $data->completed = 'COMPLETADO';
        $data->save();
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Inscripcion::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
        //Buscando Obj
        $data=Inscripcion::findOrfail($request->id); 
        if($data){
            return ['Inscripcion'=>$data];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll()
    {
        try {
            $data = Inscripcion::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}