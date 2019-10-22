@extends('layouts.app')

@section('content')
@push('photos-head')
<link href="{{ asset('assets/css/setting-photos.css') }}" media="all" rel="stylesheet" type="text/css" />
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> --}}
@endpush
@push('footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js"
    type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js"
    type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="{{ asset('assets/js/fileinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>
<script src="{{ asset('assets/js/upload-photos.js') }}" defer></script>
@endpush
@include('shared.errors-form')
@include('shared.success-form')
<div class="row setting">
    <div class="col-md-3">
        @include('profile.particals.sidebar')
    </div>

    <div class="col-lg-9 col-sm-12 col-11">
        <div class="main-section  mb-5">
            <h1 class="text-center text-danger">Insert New Images</h1><br>

            {!! csrf_field() !!}
            <div class="form-group">
                <div class="file-loading">
                    <input id="upload_image" name="file" type="file" multiple>
                </div>
            </div>
        </div>

        <div class="bg-white">
            <h2 class="text-center text-primary">Album</h2>
            <button class="btn btn-primary ml-4" id="setting-refresh-album">Refresh</button>
            <div class="row album-photos">
                @foreach ($photos as $photo)
                <form id="delete_image_in_setting" class="d-none" method="POST"
                    action="{{ route('profile.photo.destroy',['id'=>$photo->id]) }}">
                    @csrf
                    <input type="submit"></input>
                    @method('DELETE')
                </form>
                <div class="col-md-6 mb-5">
                    <div class="image">
                        <img class="img-thumbnail setting-img"
                            src="{{ asset('uploads/photos').'/'.$photo->user_id.'/'.$photo->image }}"
                            class="rounded float-left" alt="">
                        <div id="setting-action">
                            @php
                                ($photo->share_mode == 1) ? print('<i class="fas fa-lock-open"></i>') : print('<i class="fas fa-lock"></i>');
                            @endphp
                            
                            <i class="fas fa-trash-alt" data-toggle="modal" data-target="#modalConfirmDelete_{{ $photo->id }}"></i>
                            <i class="fas fa-edit" data-toggle="modal"
                                data-target="#modalQuickView_{{ $photo->id }}"></i>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalQuickView_{{ $photo->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">

                        <!--Content-->
                        <div class="modal-content">

                            <!--Body-->
                            <div class="modal-body mb-0 p-0">
                                <img class="single-image"
                                    src="{{ asset('uploads/photos').'/'.$photo->user_id.'/'.$photo->image }}" alt="">
                            </div>

                            <!--Footer-->
                            <div class="modal-footer">
                                {!! Form::model($photo, ['id'=>'edit-photo', 'method'=>'PATCH',
                                'route'=>['profile.photo.update', $photo->id]]) !!}
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('description', null, ["placeholder" => "Enter Description",
                                        'class' => 'form-control', 'id' => 'description']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="viewcount" class="col-sm-2 col-form-label">View Count</label>
                                    <div class="col-sm-10">
                                        {!! Form::number('view_count', null, ['class' => 'form-control', 'id' =>
                                        'viewcount', 'min' => 0, 'disabled' => 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sharemode" class="col-sm-2 col-form-label">Share Mode</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('share_mode', [0 => "Private", 1 => "Public"],
                                        $photo->share_mode, ['id'=>"sharemode", "class" => "custom-select mr-sm-2"]) !!}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button"
                                    class="btn btn-outline-primary btn-rounded btn-md ml-2 float-right"
                                    data-dismiss="modal">Close</button>
                                {!! Form::close() !!}
                            </div>

                        </div>
                        <!--/.Content-->

                    </div>
                </div>

                <div class="modal fade" id="modalConfirmDelete_{{ $photo->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                        <!--Content-->
                        <div class="modal-content text-center">
                            <!--Header-->
                            <div class="modal-header d-flex justify-content-center bg-danger">
                                <p class="heading text-white-50">Are you sure?</p>
                            </div>

                            <!--Body-->
                            <div class="modal-body">

                                <i class="fas fa-times fa-4x animated rotateIn"></i>

                            </div>

                            <!--Footer-->
                            <div class="modal-footer flex-center mx-auto">
                                <a href="javascript:void(0)" onclick="deleteCallAjax({{ $photo->id }}, '{{ route('profile.photo.destroy',['id'=>$photo->id]) }}')" class="btn btn-outline-danger">Yes</a>
                                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
                            </div>
                        </div>
                        <!--/.Content-->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection