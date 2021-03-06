@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>
                    Role Management
                </h2>
            </div>
            <div class="float-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}">Create New Role</a>
                @endcan
            </div>
        </div>
    </div>

    @include('shared.success-form')

    <table class="table table-bordered bg-white">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <div class="list-inline">
                        <a class="btn btn-info list-inline-item" href="{{ route('roles.show', $role->id) }}">Show</a>
                        @can('role-edit')
                            <a class="btn btn-primary list-inline-item" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                        <div class="list-inline-item">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id, 'style'=>'display:inline']]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $roles->links() }}

@endsection