

<h1>about page {{ $id }}</h1>
<h2>About Page {{ $id }}</h2>

<a href="{{  URL:: to('/') }}"> Beck to Home</a>

<a href="{{ route('section.us') }}"> Beck to section</a>

@extends('layouts.master')

@section('content')
<h1>About page</h1>
  <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero omnis delectus corrupti enim eveniet nemo hic sint quam odit architecto similique, eos voluptatem nesciunt ad corporis placeat doloremque tempore minima commodi obcaecati dolore cum ratione amet praesentium! Quia aspernatur voluptate dicta similique harum ipsa, cupiditate soluta vitae iste impedit nulla.</p>  
@endsection
@section('title')
About
    
@endsection