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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            @foreach($categoriesMenu as $category)
            <li class="nav-item">
              <a class="nav-link" href="#">{{ $category->name }}</a>
            </li>
            @endforeach
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item logged-user">
                <a href="{{ route('cart.index') }}" class="nav-link"> 
                  <i class="fa-solid fa-cart-shopping"></i>
                  @if(session()->has('cart') && count(session()->get('cart')) != 0) 
                  <span class="badge bg-danger amout-cart">{{ count(session()->get('cart')) }} </span>
                  @endif 
                </a>
            </li>
        @auth
            <li class="nav-item logged-user">
                <span class="nav-link"><i class="fa-regular fa-user"></i> {{ auth()->user()->name }}</span>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>

              <form action="{{ route('logout') }}" class="logout" method="post">
                @csrf
              </form>
            </li>
        @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Cadastro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @endauth
          </ul>
        </div>
      </div>
    </nav>

    <div class="container content">
        @include('includes.alerts')
        @yield('content')
    </div>

    @yield('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/75374810bc.js" crossorigin="anonymous"></script>
    <script src="/js/index.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>