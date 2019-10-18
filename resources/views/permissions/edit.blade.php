@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-right">
            <h2 class="font-weight-bold">Edit<i class="fas fa-edit ml-1"></i></h2>
        </div>
        <div class="float-left">
            <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
        </div>
    </div>
</div>

@include('shared.errors-form')

{!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection
