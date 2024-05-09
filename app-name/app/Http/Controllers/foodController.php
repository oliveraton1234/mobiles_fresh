<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\food;
use Illuminate\Http\Request;

class foodController extends Controller
{
    public function createFood(Request $req)
    {
        try{
            $vfood = Validator::make($req->all(), [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required'
            ]);
            if($vfood->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Error en la validacion de los datos',
                    'errors' => $vfood->errors()
                ], 422);
            }
            $food = food::create($req->all());
            return response()-> json($food, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el alimento',
                'errors' => $e->getMessage()
            ], 500);
        }
        //return food::all();
    }

    public function getFoods()
    {
        try{
            $foods = food::all();
            return response()->json($foods, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener los alimentos',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getFood($id)
    {
        try{
            $food = food::find($id);
            if($food == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el alimento'
                ], 404);
            }
            return response()->json($food, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener el alimento',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteFood($id)
    {
        try{
            $food = food::find($id);
            if($food == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el alimento'
                ], 404);
            }
            $food->delete();
            return response()->json([
                'status' => true,
                'message' => 'Alimento eliminado'
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el alimento',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function editFood(Request $req, $id)
    {
        try{
            $vfood = Validator::make($req->all(), [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required'
            ]);
            if($vfood->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Error en la validacion de los datos',
                    'errors' => $vfood->errors()
                ], 422);
            }
            $food = food::find($id);
            if($food == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el alimento'
                ], 404);
            }
            $food->update($req->all());
            return response()->json($food, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al editar el alimento',
                'errors' => $e->getMessage()
            ], 500);
        }
    }   
}
