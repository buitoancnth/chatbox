@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

@include('shared.errors-form')

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

@include('users.particals.form')

{!! Form::close() !!}


@endsection