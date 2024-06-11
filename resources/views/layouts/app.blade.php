<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        @auth
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.products.index') }}">Produtos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item logged-user">
                <span class="nav-link"><i class="fa-regular fa-user"></i> {{ auth()->user()->name }}</span>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>

              <form action="{{ route('logout') }}" class="logout" method="post">
                @csrf
              </form>
            </li>
          </ul>
        </div>
        @else
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Cadastro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        </ul>
        @endauth
      </div>
    </nav>

    <div class="container content">
        @include('includes.alerts')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/75374810bc.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/script.js"></script>
    @yield('scripts')
</body>
</html>