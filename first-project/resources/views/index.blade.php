<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1 style="text-align: center">Home page</h1>
    <ul class="list">
        <li class="list-item"><a href="{{  route('about.us') }}">About page</a></li>
        <li class="list-item"><a href="{{  route('contact.us') }}">Contact page</a></li>
        <li class="list-item"><a href="{{  route('section.us') }}">Section page</a></li>
      
    </ul>


    {!!"<h1>This loop and condition page.</h1>"!!}

@php
    $name =["Nayem","Nayemul islam","Asadul islam","Habib","Shamim","Helal"]
@endphp
<ul>
@foreach ($name as $item)
    @if ($loop->even)
        <li style="color: red";> {{$item}} </li>
    @elseif($loop->odd)
    <li style="color: blue";> {{$item}} </li>
    @else
    <li> {{$ittem}} </li>
    @endif
@endforeach
</ul>

@include('route.section')
    


</body>
</html>