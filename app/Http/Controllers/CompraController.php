<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Database\QueryException;

class CompraController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::all();
        $comprasActivos = [];
        foreach ($compras as $compra) {
            if ($compra->estado === 1) {
                array_push($comprasActivos, $compra);
            }
        }
        return $comprasActivos;
    }

      /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::find($id);
        
        if ($compra === null || $compra->estado === 0) {
            return "El compra con ID: $id, no existe";
        } else {
            $compra->cliente;
            return $compra;
        }
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $ventaActualizar = Venta::find($id);
            $compraActualizar = Compra::find($id);

            $request->cliente_id ? $ventaActualizar->cliente_id = $request->cliente_id : $ventaActualizar->cliente_id;
            $request->trabajador_id ? $ventaActualizar->trabajador_id = $request->trabajador_id : $ventaActualizar->trabajador_id;
            $request->producto_id ? $ventaActualizar->producto_id = $request->producto_id : $ventaActualizar->producto_id;
            $request->fecha ? $ventaActualizar->fecha = $request->fecha : $ventaActualizar->fecha;
            $request->cantidad ? $ventaActualizar->cantidad = $request->cantidad : $ventaActualizar->cantidad;
            $request->precio_total ? $ventaActualizar->precio_total = $request->precio_total : $ventaActualizar->precio_total;
            $request->estado ? $ventaActualizar->estado = $request->estado : $ventaActualizar->estado;
            $ventaActualizar->save();

            $request->cliente_id ? $compraActualizar->cliente_id = $request->cliente_id : $compraActualizar->cliente_id;
            $request->trabajador_id ? $compraActualizar->trabajador_id = $request->trabajador_id : $compraActualizar->trabajador_id;
            $request->producto_id ? $compraActualizar->producto_id = $request->producto_id : $compraActualizar->producto_id;
            $request->fecha ? $compraActualizar->fecha = $request->fecha : $compraActualizar->fecha;
            $request->cantidad ? $compraActualizar->cantidad = $request->cantidad : $compraActualizar->cantidad;
            $request->precio_total ? $compraActualizar->precio_total = $request->precio_total : $compraActualizar->precio_total;
            $request->estado ? $compraActualizar->estado = $request->estado : $compraActualizar->estado;
            $compraActualizar->save();

            return "La compra $id se actualizo";

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
            $compraEliminar = Compra::find($id);
            $compraEliminar->estado = 0;
            $compraEliminar->save();

            $ventaEliminar = Venta::find($id);
            $ventaEliminar->estado = 0;
            $ventaEliminar->save();

            return "El compra $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
