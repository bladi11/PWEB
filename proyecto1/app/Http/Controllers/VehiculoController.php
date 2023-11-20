<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{

    public function store(Request $request)  //para crear uno nuevo
    {
        try{
            $data['Nit'] = $request['Nit'];
            $data['Cui'] = $request['Cui'];
            $data['Propietario'] = $request['Propietario'];
            $data['Placa'] = $request['Placa'];
            $data['Marca'] = $request['Marca'];
            $data['Modelo'] = $request['Modelo'];
            $data['Color'] = $request['Color'];
            $data['Anio'] = $request['Anio'];
            $data['Cilindros'] = $request['Cilindros'];
            $data['Asientos'] = $request['Asientos'];
            $data['Chasis'] = $request['Chasis'];
            $res = Vehiculo::create($data);
            return response()->json( $res, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }   
    } 
    
    public function update(Request $request,$id)  //Funcion para actualizar
    {
        try{
            $data['id'] = $request['id'];    //faltaba el id
            $data['Nit'] = $request['Nit'];
            $data['Cui'] = $request['Cui'];
            $data['Propietario'] = $request['Propietario'];
            $data['Placa'] = $request['Placa'];
            $data['Marca'] = $request['Marca'];
            $data['Modelo'] = $request['Modelo'];
            $data['Color'] = $request['Color'];
            $data['Anio'] = $request['Anio'];
            $data['Cilindros'] = $request['Cilindros'];
            $data['Asientos'] = $request['Asientos'];
            $data['Chasis'] = $request['Chasis'];
            Vehiculo::find($id)->update($data);
            $res = Vehiculo::find($id);
            return response()->json( $res , 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    //metodo desactivar vehiculo
    public function deactivate(Request $request,$id){
        //Buscando el objeto que ya existe
        $data = Vehiculo::findOrfail($request->id);
        $data->nit = 'PENDIENTE';
        $data->save();
    }

    //metodo activar vehiculo
    public function activate(Request $request){
        //Buscando el objeto que ya existe
        $data = Vehiculo::findOrfail($request->id);
        $data->completed = 'COMPLETADO';
        $data->save();
    }

    //Metodo Eliminar
    public function destroy($id)
    {
        try {
            $res = Vehiculo::find($id)->delete();
            return response()->json([ "deleted" => $res ], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }    
    }

    //Metodo Mostrar
    public function showById(Request $request)
    {
        //Buscando Obj
        $data=Vehiculo::findOrfail($request->id); 
        if($data){
            return ['vehiculo'=>$data];
        }   
        return ['No se encontraron datos'];
    }

    public function showAll() //Mostrar todos 
    {
        try {
            $data = Vehiculo::get();
            return response()->json($data, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    } 
}
