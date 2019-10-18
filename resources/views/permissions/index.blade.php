@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>
                    Permission Management
                </h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('permissions.create') }}">Create New Permission</a>
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
        @foreach ($permissions as $key => $permission)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    @if ($permission->name != 'management-permission')
                        <div class="list-inline">
                        <a class="btn btn-primary list-inline-item" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                        <div class="list-inline-item">
                            {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id, 'style'=>'display:inline']]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{ $permissions->links() }}

@endsection