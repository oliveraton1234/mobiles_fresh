<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\restaurant;
use Illuminate\Http\Request;

class restaurantController extends Controller
{
    public function createRestaurant(Request $req)
    {

        try{
            $vrestaurant = Validator::make($req->all(), [
                'name' => 'required',
                'type' => 'required',
                'description' => 'required',
                'image' => 'required',
                'address' => 'required'
            ]);
            if($vrestaurant->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Error en la validacion de los datos',
                    'errors' => $vrestaurant->errors()
                ], 422);
            }
            $restaurant = restaurant::create($req->all());
            return response()-> json($restaurant, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el restaurante',
                'errors' => $e->getMessage()
            ], 500);
        }
        //return restaurant::all();
    }

    public function getRestaurants()
    {
        try{
            $restaurants = restaurant::all();
            return response()->json($restaurants, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener los restaurantes',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function getRestaurant($id)
    {
        try{
            $restaurant = restaurant::find($id);
            if($restaurant == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el restaurante'
                ], 404);
            }
            return response()->json($restaurant, 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al obtener el restaurante',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteRestaurant($id)
    {
        try{
            $restaurant = restaurant::find($id);
            if($restaurant == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el restaurante'
                ], 404);
            }
            $restaurant->delete();
            return response()->json([
                'status' => true,
                'message' => 'Restaurante eliminado correctamente'
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el restaurante',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function editRestaurant(Request $req, $id)
    {
        try{
            $restaurant = restaurant::find($id);
            if($restaurant == null){
                return response()->json([
                    'status' => false,
                    'message' => 'No se encontro el restaurante'
                ], 404);
            }
            $restaurant->update($req->all());
            return response()->json([
                'status' => true,
                'message' => 'Restaurante actualizado correctamente'
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Error al actualizar el restaurante',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
