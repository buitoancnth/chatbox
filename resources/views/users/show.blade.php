@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="float-left">
            <h2> Show User</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(0 !== count($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
            <label class="badge badge-success">{{ $v }}</label>
            @endforeach
            @else
            <p>dont have role</p>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <button class="btn btn-primary" data-toggle="modal" data-target="#send_message">Send message</button>
</div>

<div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="send_message" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Tới: {{ $user->name }}</h5>
                <textarea title="Soạn một tin nhắn..." name="massage_body" id="massage_body" cols="63" rows="4" placeholder="Soạn một tin nhắn..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>
@endsection