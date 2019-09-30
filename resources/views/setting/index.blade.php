@extends('layouts.app')

@section('content')
    @include('shared.errors-form')
    @include('shared.success-form')
    <div class="row setting">
        <div class="col-md-4">
            @include('setting.particals.sidebar')
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">Information</div>
                <div class="card-body">
                {!! Form::model($current_user, ['method'=>'PATCH', 'route' => 'edit-profile']) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}
                    </div>

                    <div class="form-group">
                        <strong>Email:</strong>
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}
                    </div>

                    <div class="form-group">
                        <strong>Password:</strong>
                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <strong>Confirm Password:</strong>
                        {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Update', ['class' => 'btn btn-primary mt-1']) !!}
                {!! Form::close() !!}
                </div>    
            </div>
        </div>
    </div>
@endsection