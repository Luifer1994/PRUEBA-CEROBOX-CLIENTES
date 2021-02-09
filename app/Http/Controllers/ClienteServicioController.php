<?php

namespace App\Http\Controllers;

use App\Models\ClienteServicio;
use Illuminate\Http\Request;

class ClienteServicioController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //VALIDAMOS QUE LOS DATOS QUE LLEGAN DEL FORMULARIO NO ESTEN VACIOS
        $request->validate([
            'id_cliente' => 'required',
            'id_servicio' => 'required',
            'fechaInicio' => 'required',
            'fechaFinal' => 'required',
            'observaciones' => 'required',
        ]);

        $newClienteServicio = new ClienteServicio();

        $newClienteServicio->id_cliente=$request->id_cliente;
        $newClienteServicio->id_servicio=$request->id_servicio;
        $newClienteServicio->fecha_inicio=$request->fechaInicio;
        $newClienteServicio->fecha_final=$request->fechaFinal;
        $newClienteServicio->observaciones=$request->observaciones;

        $newClienteServicio->save();

        return back()->with('mensaje', 'REGISTRO EXITOSO');

    }


    public function show(ClienteServicio $clienteServicio)
    {
        //
    }


    public function edit(ClienteServicio $clienteServicio)
    {
        //
    }


    public function update(Request $request, ClienteServicio $clienteServicio)
    {
        //
    }


    public function destroy(ClienteServicio $clienteServicio)
    {
        //
    }
}
