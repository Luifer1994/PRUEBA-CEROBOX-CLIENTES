<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('clientes.index') }}"><h4><img class="img-fluid" alt="..." width="60px" src="{{ asset('image/logo-cerobox.svg') }}"> Cerobox</h4></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i style="font-size: 30px" class="fas fa-user text-light"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"><h5>{{ Auth::user()->name }}</h5></a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}">Cerrar sesion</a>
            </div>
          </li>
        <li class="nav-item active mx-2">
          <a class="nav-link py-3" href="{{ route('clientes.index') }}"><h6>Clientes </h6><span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link py-3" href="{{ route('servicios.index') }}"><h6>Servicios</h6></a>
        </li>
      </ul>
    </div>
  </nav>
