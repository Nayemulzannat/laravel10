<a href="{{ url('/') }}">Beck to Home</a>
@extends('layouts.master')
@section('showuser')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>All User List</h1>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>VieW</th>
                    </tr>
                    @foreach ($data as $id => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td><a href="{{ route('singleUser.us',$user->id) }}" class="btn btn-primary btn-lg">View</a></td>
                  
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
