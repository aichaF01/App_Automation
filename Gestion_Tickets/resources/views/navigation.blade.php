<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href=""><i class="fa-solid fa-house"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
         @if(Auth::check() && Auth::user()->type_user == 'user')
          <li class="nav-item">
              <a class="nav-link {{ request()->is('ticketsUser') ? 'active' : '' }}" aria-current="page" href="/ticketsUser">Tickets</a>
          </li>
        @endif
        @if(Auth::check() && Auth::user()->type_user == 'user')
          <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Créer Ticket</a>
          </li>
        @endif
        @if(Auth::check() && Auth::user()->type_user == 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('ticket') ? 'active' : '' }}" href="/ticket">Tickets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="/users">Utilisateurs inscrits</a>
          </li>
        @endif
        <li class="nav-item">
          @if(Auth::check())
              <a class="nav-link" href="/logout">Se déconnecter</a>
          @else   
              <a class="nav-link" href="/login">Se connecter</a>
          @endif
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>