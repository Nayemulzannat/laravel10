<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masterlayout - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
        </div>
      </nav>
    {{-- <nav>
        <ul class="list">
            <li class="list-item"><a href="{{ route('about.us') }}">About page</a></li>
            <li class="list-item"><a href="{{ route('contact.us') }}">Contact page</a></li>
            <li class="list-item"><a href="{{ route('section.us') }}">Section page</a></li>
            <li class="list-item"><a href="{{ route('showuser.us') }}">ShowUser page</a></li> --}}
    {{-- <li class="list-item"><a href="{{  route('adduser.us') }}">AddUser page</a></li> --}}
    {{-- </ul>
    </nav> --}}
    {{-- @hasSection 
        ('content')
        @yield('content')
    @else
        <h2>No Contact Found</h2>
    @endif --}}
    @yield('showuser')

    @yield('addUser')
    @yield('updateUser')
</body>

</html>
