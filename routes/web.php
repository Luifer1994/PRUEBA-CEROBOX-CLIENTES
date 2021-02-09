<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ClienteServicioController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//RUTA QUE VA AL CONTROLADOR CLIENTES Y DEVUELVE LA VISTA INDEX SI EXITE LA SESION SE UTILIZA EL MIDDLEWARE AUTH:SABCTUM PARA
//PROTEGER LAS RUTAS
Route::middleware(['auth:sanctum', 'verified'])->get('/', [ClientesController::class, 'index']);

//RUTA DE TIPO RESOURCE QUE CONTIENE TODOS LOS METODOS DEL CRUD DEL CONTROLADOR Clientes
Route::middleware(['auth:sanctum', 'verified'])->resource('/clientes', ClientesController::class)->names('clientes')->parameters(['clientes' => 'request']);

//RUTA QUE DEVUELVE LOS DETALLES DE LOS CLIENTES DESDE EL CONTROLADOR CLIENTE
Route::middleware(['auth:sanctum', 'verified'])->get('/detalles/{id}', [ClientesController::class, 'detalles'])->name('detalles');

//RUTA DE TIPO RESORCE QUE NOS PERMITE ACCEDE A TODOS LOS METODOS DEL CRUD DEL CONTROLADOR SERVICIOS
Route::middleware(['auth:sanctum', 'verified'])->resource('/servicios', ServiciosController::class)->names('servicios')->parameters(['servicios' => 'request']);

//RUTA QUE NOS DA ACCESO A LOS METODOS DEL CRUD DEL CONTROLADOR ClientesServiciosController
Route::middleware(['auth:sanctum', 'verified'])->resource('/servicio', ClienteServicioController::class)->names('servicio')->parameters(['servicio' => 'request']);

//RUTA QUE DESTRUYE LA SESION
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//RUTA QUE BLOQUEA EL REGISTRO MANUAL DESDE LA URL SI NO EXISTE LA SESION
Route::middleware(['auth:sanctum', 'verified'])->get('/register');
