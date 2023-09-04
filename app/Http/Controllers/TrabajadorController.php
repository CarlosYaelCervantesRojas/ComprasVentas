<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajadores = Trabajador::all();
        $trabajadoresActivos = [];
        foreach ($trabajadores as $trabajador) {
            if ($trabajador->estado === 1) {
                array_push($trabajadoresActivos, $trabajador);
            }
        }
        return $trabajadoresActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevotrabajador = new trabajador();

            $nuevotrabajador->nombre = $request ->nombre;
            $nuevotrabajador->direccion = $request ->direccion;
            $nuevotrabajador->telefono = $request ->telefono;
            $nuevotrabajador->correo = $request ->correo;
            $nuevotrabajador->estado = 1;

            $nuevotrabajador->save();
            return "trabajador creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trabajador = Trabajador::find($id);
        
        if ($trabajador === null || $trabajador->estado === 0) {
            return "El trabajador con ID: $id, no existe";
        } else {
            $trabajador->ventas;
            return $trabajador;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $trabajadorActualizar = Trabajador::find($id);

            $request->nombre ? $trabajadorActualizar->nombre = $request->nombre : $trabajadorActualizar->nombre;
            $request->direccion ? $trabajadorActualizar->direccion = $request->direccion : $trabajadorActualizar->direccion;
            $request->telefono ? $trabajadorActualizar->telefono = $request->telefono : $trabajadorActualizar->telefono;
            $request->correo ? $trabajadorActualizar->correo = $request->correo : $trabajadorActualizar->correo;
            $request->estado ? $trabajadorActualizar->estado = $request->estado : $trabajadorActualizar->estado;
            $trabajadorActualizar->save();

            return "El trabajador $id se actualizo";

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
            $trabajadorEliminar = Trabajador::find($id);
            $trabajadorEliminar->estado = 0;
            $trabajadorEliminar->save();

            return "El trabajador $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
