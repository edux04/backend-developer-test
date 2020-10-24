@extends('layouts.principal')

@section('pageTitle', 'Api')
@section('endpoint', 'Elija la opción a probar')
@section('content')

<p>Las rutas estan protegidas con authenticación Laravel Passport por lo que debe probar las funciones
    en el siguiente orden:
</p>
<ul>
    <li>1. Registra un usuario</li>
    <li>2. Inicia sesión con el usuario y copia el token recibido *paso obligatorio*</li>
    <li>3. Prueba el resto de las funciones siempre utilizando el token</li>
</ul>
@endsection
