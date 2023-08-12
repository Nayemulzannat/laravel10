<a href="{{ url('/') }}">Beck to Home</a>
@extends('layouts.master')
@section('addUser')
    <div class="container">
        <div class="row">
           <div class="col-4">
            <h1>Add New User</h1>
            <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
              </form>
           </div>
        </div>
    </div>
@endsection