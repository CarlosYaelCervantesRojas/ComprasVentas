<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $productosActivos = [];
        foreach ($productos as $producto) {
            if ($producto->estado === 1) {
                array_push($productosActivos, $producto);
            }
        }
        return $productosActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevoProducto = new Producto();

            $nuevoProducto->nombre = $request ->nombre;
            $nuevoProducto->codigo = $request ->codigo;
            $nuevoProducto->descripcion = $request ->descripcion;
            $nuevoProducto->precio = $request ->precio;
            $nuevoProducto->estado = 1;

            $nuevoProducto->save();
            return "Producto creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        
        if ($producto === null || $producto->estado === 0) {
            return "El pr$producto con ID: $id, no existe";
        } else {
            return $producto;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $productoActualizar = Producto::find($id);

            $request->nombre ? $productoActualizar->nombre = $request->nombre : $productoActualizar->nombre;
            $request->codigo ? $productoActualizar->codigo = $request->codigo : $productoActualizar->codigo;
            $request->descripcion ? $productoActualizar->descripcion = $request->descripcion : $productoActualizar->descripcion;
            $request->precio ? $productoActualizar->precio = $request->precio : $productoActualizar->precio;
            $request->estado ? $productoActualizar->estado = $request->estado : $productoActualizar->estado;
            $productoActualizar->save();

            return "El producto $id se actualizo";

        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $productoEliminar = Producto::find($id);
            $productoEliminar->estado = 0;
            $productoEliminar->save();

            return "El producto $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
