<a href="{{ url('/') }}">Beck to Home</a>
@extends('layouts.master')
@section('updateUser')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h1>Add New User</h1>
                        <form action="{{ route('update.user',$data->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" value="{{$data->name}}" class="form-control" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone</label>
                                <input type="text" value="{{$data->phone}}" class="form-control" name="userphone">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" value="{{$data->email}}" class="form-control" name="useremail">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">City</label>
                                <input type="text" value="{{$data->city}}" class="form-control" name="usercity">
                            </div>
                            <button type="submit"class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
