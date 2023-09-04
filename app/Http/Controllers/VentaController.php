<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class VentaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::all();
        $ventasActivos = [];
        foreach ($ventas as $venta) {
            if ($venta->estado === 1) {
                array_push($ventasActivos, $venta);
            }
        }
        return $ventasActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevaVenta = new Venta();
            $nuevaCompra = new Compra();

            $nuevaVenta->cliente_id = $request ->cliente_id;
            $nuevaVenta->trabajador_id = $request ->trabajador_id;
            $nuevaVenta->producto_id = $request ->producto_id;
            $nuevaVenta->fecha = $request ->fecha;
            $nuevaVenta->cantidad = $request ->cantidad;
            $nuevaVenta->precio_total = $request ->precio_total;
            $nuevaVenta->estado = 1;

            $nuevaCompra->cliente_id = $request ->cliente_id;
            $nuevaCompra->trabajador_id = $request ->trabajador_id;
            $nuevaCompra->producto_id = $request ->producto_id;
            $nuevaCompra->fecha = $request ->fecha;
            $nuevaCompra->cantidad = $request ->cantidad;
            $nuevaCompra->precio_total = $request ->precio_total;
            $nuevaCompra->estado = 1;

            $nuevaVenta->save();
            $nuevaCompra->save();
            return "Venta creada";

        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::find($id);
        
        if ($venta === null || $venta->estado === 0) {
            return "El venta con ID: $id, no existe";
        } else {
            $venta->trabajador;
            return $venta;
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

            return "La venta $id se actualizo";

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
            $ventaEliminar = Venta::find($id);
            $ventaEliminar->estado = 0;
            $ventaEliminar->save();

            $compraEliminar = Compra::find($id);
            $compraEliminar->estado = 0;
            $compraEliminar->save();

            return "El venta $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
