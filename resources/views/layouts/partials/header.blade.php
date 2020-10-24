
  <div>
    <h1>Backend Developer Test</h1>

</div>
<ul> <li><a href="{{ url('/') }}">Inicio</a></li>
    <li><a href="{{ url('users/register') }}">Registrar usuario</a></li>
    <li><a href="{{ url('users/login') }}">Hacer login de usuario</a></li>
    <li><a href="{{ url('users/') }}">Listar usuarios registrados</a></li>
    <li><a href="{{ url('users/') }}">Eliminar usuarios</a></li>
    <li><a href="{{ url('users/update') }}">Actualizar datos del usuarios</a></li>
    <li><a href="{{ url('password/email/') }}">Recuperar contraseña</a></li>
</ul>
<hr>
<h2>@yield('endpoint')</h2>
