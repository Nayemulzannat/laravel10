@extends('layouts.master')
@section('showuser')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>All User List</h1>
                <a href="newuser" class="btn btn-success btn-lg mb-3">Add user</a>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>View</th>
                        <th>Delete</th>
                        <th>Update</th>
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
                            <td><a href="{{ route('singleUser.us', $user->id) }}" class="btn btn-primary btn-lg">View</a></td>
                            <td><a href="{{ route('deleteUser.us', $user->id) }}" class="btn btn-danger btn-lg">Delete</a></td>
                            <td><a href="{{ route('updatePage', $user->id) }}" class="btn btn-warning btn-lg">Update</a></td>
                            {{-- <td><a href="updatePage" class="btn btn-warning btn-lg">Update</a></td> --}}

                        </tr>
                    @endforeach
                </table>
                {{-- <button style="test-color:rgb(255, 0, 0);" class="btn btn-primary"><a href="{{ url('/') }}">Beck to Home</a></button> --}}
                <a href="{{ url('/') }}">Beck to Home</a>

            </div>
        </div>
    </div>
@endsection
