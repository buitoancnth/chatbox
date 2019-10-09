@extends('layouts.app')

@section('content')
    @push('photos-head')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
    @endpush
    @push('footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>
        <script src="{{ asset('assets/js/upload-photos.js') }}"></script>
    @endpush
@include('shared.errors-form')
@include('shared.success-form')
<div class="row setting">
    <div class="col-md-4">
        @include('setting.particals.sidebar')
    </div>

    <div class="col-md-8">
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-6">
                    <img src="..." class="rounded float-left" alt="">
                </div>
            @endforeach
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-11 main-section">
                    <h1 class="text-center text-danger">File Input Example</h1><br>
                    
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="file-loading">
                                <input id="file-1" type="file" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection