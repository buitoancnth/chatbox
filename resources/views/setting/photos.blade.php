@extends('layouts.app')

@section('content')
    @push('photos-head')
        <link href="{{ asset('assets/css/setting-photos.css') }}" media="all" rel="stylesheet" type="text/css" />
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" /> --}}
    @endpush
    @push('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="{{ asset('assets/js/fileinput.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>
        <script src="{{ asset('assets/js/upload-photos.js') }}" defer></script>
    @endpush
@include('shared.errors-form')
@include('shared.success-form')
<div class="row setting">
    <div class="col-md-3">
        @include('setting.particals.sidebar')
    </div>

    <div class="col-lg-9 col-sm-12 col-11 main-section">
        
        <h1 class="text-center text-danger">Insert New Images</h1><br>
        
        {!! csrf_field() !!}
        <div class="form-group">
            <div class="file-loading">
                <input id="upload_image" name="file" type="file" multiple>
            </div>
        </div>
        <div class="row">
            @foreach ($photos as $photo)
            @php
                // dd($photo)
            @endphp
                <div class="col-md-6 mb-5">
                    <img class="img-thumbnail" src="{{ asset('uploads/photos').'/'.$photo->user_id.'/'.$photo->image }}" class="rounded float-left" alt="">
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection