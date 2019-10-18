@extends('layouts.app')

@section('content')
@include('shared.errors-form')
@include('shared.success-form')
<div class="row setting">
    <div class="col-md-3">
        @include('profile.particals.sidebar')
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-primary">Information</div>
            <div class="card-body">
                {!! Form::model($current_user, ['method'=>'PATCH', 'route' => 'edit-profile']) !!}
                <div class="row">
                    <div class="mx-auto col-lg-4 col-sm-12">
                        <label class="cabinet avatar">
                            <figure>
                                <img src="{{ asset('uploads/avatars').'/'.$current_user->avatar }}"
                                    class="gambar img-responsive img-thumbnail" id="item-img-output" />
                                <figcaption><i class="fas fa-camera"></i></figcaption>
                            </figure>
                            <input type="file" class="item-img file d-none" name="file_avatar" />
                            <input type="hidden" class="item-img file d-none" name="avatar_name" id="avatar_name" />
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::text('head_line', null, ['class' => 'form-control', 'placeholder'=>"What's on your mind?"]) !!}
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
                    <strong>Birth Day:</strong>
                    {!! Form::date('birth_day', null, ['class' => 'form-control', 'placeholder'=>'Birth Day']) !!}
                </div>

                <div class="form-group">
                    <strong>Address:</strong>
                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder'=>'Address']) !!}
                </div>

                <div class="form-group">
                    <strong>Job:</strong>
                    {!! Form::text('job', null, ['class' => 'form-control', 'placeholder'=>'Job']) !!}
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    Edit Photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="upload-avatar" class="center-block"></div>
                    </div>
                    <div class="col-md-3">
                        <img id="preview_square" src="" class="img-responsive img-thumbnail"></img>
                        <h5 class="text-center mt-2">Preview</h5>
                    </div>
                    <div class="col-md-3">
                        <img id="preview_circle" src="" class="img-thumbnail rounded-circle"></img>
                        <h5 class="text-center mt-2">Preview</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection
