<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Juego;

class JuegoController extends Controller
{
    //metodo guardar/crear
    public function store(Request $request)
    {
            try {
                $data['Nombre'] = $request['Nombre'];
                $data['Modo'] = $request['Modo'];
                $data['Tipo'] = $request['Tipo'];
                $res = Juego::create($data);
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
            $data['Modo'] = $request['Modo'];
            $data['Tipo'] = $request['Tipo'];
            Juego::find($id)->update($data);
            $res = Juego::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Juego::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
        //Buscando Obj
        $data=Juego::findOrfail($request->id); 
        if($data){
            return ['Juego'=>$data];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll()
    {
        try {
            $data = Juego::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}