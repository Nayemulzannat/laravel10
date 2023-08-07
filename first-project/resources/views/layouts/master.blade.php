<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>masterlayout - @yield('title')</title>
</head>
<body>
    <nav>
        <ul class="list">
            <li class="list-item"><a href="{{  route('about.us') }}">About page</a></li>
            <li class="list-item"><a href="{{  route('contact.us') }}">Contact page</a></li>
            <li class="list-item"><a href="{{  route('section.us') }}">Section page</a></li>
          
        </ul>
    </nav>
    <article>
        @hasSection ('content')
          @yield('content')
        @else
        <h2>No Contact Found</h2>
        @endif
      
    </article>
</body>
</html>