<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ClienteController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        // return $clientees;
        $clientesActivos = [];
        foreach ($clientes as $cliente) {
            if ($cliente->estado === 1) {
                array_push($clientesActivos, $cliente);
            }
        }
        return $clientesActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevocliente = new Cliente();

            $nuevocliente->nombre = $request ->nombre;
            $nuevocliente->direccion = $request ->direccion;
            $nuevocliente->telefono = $request ->telefono;
            $nuevocliente->correo = $request ->correo;
            $nuevocliente->estado = 1;

            $nuevocliente->save();
            return "cliente creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        
        if ($cliente === null || $cliente->estado === 0) {
            return "El cliente con ID: $id, no existe";
        } else {
            return $cliente;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $clienteActualizar = Cliente::find($id);

            $request->nombre ? $clienteActualizar->nombre = $request->nombre : $clienteActualizar->nombre;
            $request->direccion ? $clienteActualizar->direccion = $request->direccion : $clienteActualizar->direccion;
            $request->telefono ? $clienteActualizar->telefono = $request->telefono : $clienteActualizar->telefono;
            $request->correo ? $clienteActualizar->correo = $request->correo : $clienteActualizar->correo;
            $request->estado ? $clienteActualizar->estado = $request->estado : $clienteActualizar->estado;
            $clienteActualizar->save();

            return "El cliente $id se actualizo";

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
            $clienteEliminar = Cliente::find($id);
            $clienteEliminar->estado = 0;
            $clienteEliminar->save();

            return "El cliente $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
