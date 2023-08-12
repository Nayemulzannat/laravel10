<h1>User Details</h1>
@foreach ($data as $user)
    

<h3>Id: {{ $user->id }}</h3>
<h3>Name: {{ $user->name }}</h3>
<h3>Phone: {{ $user->phone }}</h3>
<h3>Email: {{ $user->email }}</h3>
<h3>City: {{ $user->city }}</h3>
<h3>created_at: {{ $user->created_at }}</h3>
<h3>updated_at: {{ $user->updated_at }}</h3>
@endforeach