<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Moto;

class MotoController extends Controller
{

    public function store(Request $request)  //para crear uno nuevo
    {
        try{
            $data['Marca'] = $request['Marca'];
            $data['Modelo'] = $request['Modelo'];
            $data['Anio'] = $request['Anio'];
            $data['Motor'] = $request['Motor'];
            $data['Color'] = $request['Color'];
            $res = Moto::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }   
    } 
    
    public function update(Request $request,$id)  //Funcion para actualizar
    {
        try{
            $data['id'] = $request['id'];    //faltaba el id
            $data['Marca'] = $request['Marca'];
            $data['Modelo'] = $request['Modelo'];
            $data['Anio'] = $request['Anio'];
            $data['Motor'] = $request['Motor'];
            $data['Color'] = $request['Color'];
            Moto::find($id)->update($data);
            $res = Moto::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Moto::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
       
        $data=Moto::findOrfail($request->id); 
        if($data){
            return ['moto'=>$data];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll() //Mostrar todos 
    {
        try {
            $data = Moto::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    } 
}