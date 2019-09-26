@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>Users Management</h2>
            </div>
            <div class="float-right">
                <a class= "btn btn-success" href="{{ route('users.create') }}">Create new users</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (0 !== count($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $role)
                            <label class="badge badge-success">{{ $role }}</label>
                        @endforeach
                    @else
                        dont have role
                    @endif
                </td>
                <td>
                    <div class="list-inline">
                        <a class="btn btn-info list-inline-item" href="{{ route('users.show',$user->id) }}">Show</a>
                        @can('user-edit')
                            <a class="btn btn-primary list-inline-item" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        @endcan
                        @can('user-delete')
                        <div class="list-inline-item">
                            <form method="POST" action="{{url('/users', ['id' => $user->id])}}">
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('are you sure?')">Delete</button>
                                @method('DELETE')
                            </form>
                        </div>
                        @endcan
                    </div>
                    
                </td>
            </tr>
        @endforeach
    </table>
@endsection