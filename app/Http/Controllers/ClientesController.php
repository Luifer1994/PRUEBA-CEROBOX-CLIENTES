<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\ClienteServicio;
use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{

    public function index()
    {
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes'));
    }



    //METODO QUE RESIBE LOS DATOS DEL NUEVO CLIENTE A REGISTRAR
    public function store(Request $request)
    {

        //VALIDAMOS QUE LOS DATOS QUE LLEGAN DEL FORMULARIO NO ESTEN VACIOS
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
            'celular' => 'required',
            'observaciones' => 'required',
            'imagen' => 'required|image'
        ]);

        //INSTANCIA DEL MODELO
        $newCliente = new Clientes();

        //ASIGNAMOS Y GUARDAMOS ESTOS 5 CAMPOS EN LA TABLA
        $newCliente->nombre=$request->nombre;
        $newCliente->email=$request->email;
        $newCliente->celular=$request->celular;
        $newCliente->cedula=$request->cedula;
        $newCliente->observaciones=$request->observaciones;

        $newCliente->save();

        //OPTENEMOS EL ULTIMO REGISTRO REALIZADO PARA OPTENER EL ID
        $data2 = Clientes::latest('id')->first();

        //GUARDAMOS LA IMAGEN EN EL SERVIDOR ASIGNANDO UNA RUTA ESPESIFICA CON EL ID
        $filename = $request->file('imagen')->store('imagenes/clientes/'.$data2->id,'public');

        //ASIGNAMOS LA RUTA DE LA IMAGEN AL CAMPO FOTO DEL ULTIMO REGISTRO Y GUARDAMOS
        $data2->imagen=$filename;
        $data2->save();

        //RETORNAMOS A LA VISTA ANTERIOR Y MANDAMOS UN MENSAJE DE EXITO
        return back()->with('mensaje', 'REGISTRO EXITOSO');
    }


    //ACTUALIZAR REGISTRO
    public function update(Request $request, $id)
    {
        //VALIDAMOS QUE LOS DATOS QUE LLEGAN DEL FORMULARIO NO ESTEN VACIOS
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
            'celular' => 'required',
            'observaciones' => 'required',
        ]);


             //SI MANDAMOS UNA IMAGEN DESDE EL FORMULARIO SE DA ESTA FUNCION
        if ($request->file('imagen')!=null) {

            //CONSULTAMOS EL SERVICIO EN ESPESIFICO
            $cliente = Clientes::find($id);

            //Y COMO MANDAMOS UNA NUEVA IMAGEN BORRAMOS LA QUE YA ESTABA EN EL SERVIDOR
            Storage::delete('public/'.$cliente->imagen);
             //GUARDAMOS LA NUEVA FOTO
            $filename = $request->file('imagen')->store('imagenes/clientes/'.$cliente->id,'public');

            //GUARDAMOS EL CAMPO EN LA TABLA CON LA RUTA DE LA IMAGEN
            $cliente->imagen=$filename;

            $cliente->save();

        }

        // SI NO PASA LA VALIDACION ANTERIOS SE CUMPLE ESTA FUNCION
            $cliente = Clientes::find($id);
            $cliente->nombre=$request->nombre;
            $cliente->email=$request->email;
            $cliente->celular=$request->celular;
            $cliente->cedula=$request->cedula;
            $cliente->observaciones=$request->observaciones;

            $cliente->save();
            return back()->with('mensaje', 'ACTUALIZACION EXITOSA');

    }

    //MUESTRA LOS DETALLES DE UN CLIENTE EN ESPESIFICO
    public function detalles($id)
    {
        //CONSULTAMOS EL CLIENTE EN ESPESIFICO CON EL PARAMETRO ID
        $cliente = Clientes::find($id);

        //CONSULTA TODOS LOS SERVICIOS
        $servicios = Servicios::all();

        //CONSULTA LA TABLA PIVOTE DONDE SE GUARDA LA RELACION ENTRE SERVICIOS Y CLIENTES
        $servicioClientes = ClienteServicio::select('cliente_servicios.*', 'servicios.nombre as nombreServicio')
        ->join('servicios', 'cliente_servicios.id_servicio', '=', 'servicios.id' )
        ->where('cliente_servicios.id_cliente', '=', $id)
        ->get();

        //RETORNAMOS LA VISTA DETALLES Y MANDAMOS POR COMPACT LAS VARIABLES QUE TIENEN LAS CONSULTAS
        return view('clientes.detalles', compact('cliente', 'servicioClientes','servicios'));
    }

    //ELIMINA UN CLIENTE
    public function destroy($id)
    {
        //CONSULTA POR PARAMETRO EL CLIENTE
        $cliente = Clientes::find($id);

        //BORRAMOS LA IMAGEN QUE LE PERTENECE AL CLIENTE EN EL SERVIDOR
        Storage::delete('public/'.$cliente->imagen);

        //OBTENEMOS UN ARRAY CON EL ID DE LA TABLA PIVOTE DONDE SE RELACIONA CLIENTES Y SERVICIOS
        $registros= ClienteServicio::where('id_cliente', $id)->get()->toArray();

        //ELIMINAMOS LOS REGISTROS DE LA RELACION EN LA TABLA PIVOTE DEL CLIENTE Y SERVICOS
        ClienteServicio::destroy($registros);


        //BORRAMOS EL CLIENTE
        $cliente->delete();
        return back()->with('mensaje2', 'Cliente eliinado con exito');
    }
}
