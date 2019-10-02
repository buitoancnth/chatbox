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
                <div class="row">
                    <div class="mx-auto col-lg-4 col-sm-12">
                        <label class="cabinet avatar">
                            <figure>
                                <img src="" class="gambar img-responsive img-thumbnail" id="item-img-output" />
                                <figcaption><i class="fas fa-camera"></i></figcaption>
                            </figure>
                            <input type="file" class="item-img file d-none" name="file_photo" />
                        </label>
                    </div>
                </div>

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
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' =>
                    'form-control']) !!}
                </div>
                {!! Form::submit('Update', ['class' => 'btn btn-primary mt-1']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                        Edit Photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block"></div>
                <div id="preview"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection