<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiciosController extends Controller
{

    public function index()
    {
        //CONSULTA AL MODELO Servicios Y HACEMOS UN JOIN CON LA TABLA TIPOS DE SERVICIOS
        $servicios = Servicios::select('servicios.*', 'tipo_servicios.nombre as nombreTipoServicio')
        ->join('tipo_servicios', 'servicios.id_tipo_servicio', '=', 'tipo_servicios.id')->get();

        //CONSULTAMOS TODOS LOS TIPOS DE SERVICIOS Y LOS MANDAMOS A LA VISTA servicios.index
        $tipoServicios   = TipoServicio::all();
        return view('servicios.index', compact('servicios','tipoServicios'));
    }


    //CREAMOS UN NUEVO REGISTRO DESDE ESTE METODO
    public function store(Request $request)
    {

        //VALIDACION DE CAMPOS
        $request->validate([
            'nombre' => 'required',
            'tipoServicio' => 'required',
            'imagen' => 'required|image'
        ]);

        //INSTANCIA DEL MODELO SERVICIOS
        $newServicio = new Servicios();

        //ASIGNAMOS Y GUARDAMOS 2 CAMPOS EN LA TABLA SERVICIOS
        $newServicio->nombre=$request->nombre;
        $newServicio->id_tipo_servicio=$request->tipoServicio;
        $newServicio->save();

        //OPTENEMOS EL ULTIMO REGISTRO REALIZADO PARA OPTENER EL ID
        $data2 = Servicios::latest('id')->first();

        //GUARDAMOS LA IMAGEN EN EL SERVIDOR ASIGNANDO UNA RUTA ESPESIFICA CON EL ID
        $filename = $request->file('imagen')->store('imagenes/servicios/'.$data2->id,'public');

        //ASIGNAMOS LA RUTA DE LA IMAGEN AL CAMPO FOTO DEL ULTIMO REGISTRO Y GUARDAMOS
        $data2->foto=$filename;
        $data2->save();

        //RETORNAMOS A LA VISTA ANTERIOR Y MANDAMOS UN MENSAJE DE EXITO
        return back()->with('mensaje', 'REGISTRO EXITOSO');

    }



    //ACTUALIZAR REGISTRO
    public function update(Request $request, $id)
    {
        //VALIDAMOS QUE LOS DATOS QUE LLEGAN DEL FORMULARIO NO ESTEN VACIOS
        $request->validate([
            'nombre' => 'required',
            'tipoServicio' => 'required',
        ]);



        //SI MANDAMOS UNA IMAGEN DESDE EL FORMULARIO SE DA ESTA FUNCION
        if ($request->file('imagen')!=null) {

            //CONSULTAMOS EL SERVICIO EN ESPESIFICO
            $servicio = Servicios::find($id);

            //Y COMO MANDAMOS UNA NUEVA IMAGEN BORRAMOS LA QUE YA ESTABA EN EL SERVIDOR
            Storage::delete('public/'.$servicio->foto);
            //GUARDAMOS LA NUEVA FOTO
            $filename = $request->file('imagen')->store('imagenes/clientes/'.$servicio->id,'public');

            //GUARDAMOS EL CAMPO EN LA TABLA CON LA RUTA DE LA IMAGEN
            $servicio->foto=$filename;

            $servicio->save();

        }

           // SI NO PASA LA VALIDACION ANTERIOS SE CUMPLE ESTA FUNCION
            $servicio = Servicios::find($id);
            $servicio->nombre=$request->nombre;
            $servicio->id_tipo_servicio=$request->tipoServicio;

            $servicio->save();
            return back()->with('mensaje', 'ACTUALIZACION EXITOSA');
    }

}
