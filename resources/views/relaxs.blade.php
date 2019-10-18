@extends('layouts.app')

@section('content-relax')

<div class="content bg-white">
    <h2 class="text-center text-primary">DatingFFUN in the Photos</h2>
    <div class="social-media">
        <h4 class="text-info text-center">Join us on Social Media</h4>
        <a href="https://www.facebook.com/buitoan.ncth.9" target="_blank">
            <img src="{{ asset('assets/img/fb.svg') }}" width="40px" height="40px" alt="fb">
        </a>
        <a href="https://www.facebook.com/buitoan.ncth.9" target="_blank">
            <img src="{{ asset('assets/img/instagram.svg') }}" width="40px" height="40px" alt="in">
        </a>
    </div>

    <div class="filter">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label for="filter-photos" class="text-info">Filter Photos By Category</label>
                    <select class="form-control" name="filter-photos" id="filter-photos">
                        <option>Girl</option>
                        <option>Man</option>
                        <option>Gay</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row row-photos">
            @foreach ($photos as $photo)
            <div class="col-sm-12 col-md-6 col-lg-3  photo-relax">
                <div class="card">
                    <img class="card-img-top" src="uploads/photos/{{ $photo->user_id }}/{{ $photo->image }}" alt="Card image cap">
                    <div class="card-body">
                        <a href="{{ route('users.show', $photo->user_id) }}" class="link_to_user"><h5 class="text-primary card-title text-capitalize font-weight-bold">{{ $photo->user->name }} - {!! Helper::getAge($photo->user->birth_day) !!} years old</h5></a>
                        <p class="card-text"><i class="fab fa-think-peaks"></i>{{ $photo->user->head_line }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-birthday-cake"></i>{{ $photo->user->birth_day }}</li>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i>{{ $photo->user->address }}</li>
                        <li class="list-group-item"><i class="fas fa-briefcase"></i>{{ $photo->user->job }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link"><i class="far fa-heart"></i>123</a>
                        <a href="#" class="card-link float-right">{{ $photo->updated_at }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row footer-relaxs">
            <div class="col-sm-12 col-md-2 offset-md-5">
                <a href="#" id="loadMore">Load More</a>
            </div>

            <div id="totop" class="totop"> 
                <a href="#top"><img src="uploads/local/move.png" alt=""></a> 
            </div>
        </div>
    </div>
</div>

{{-- <h1>Images</h1>
    <div class="relaxs">
        <div class="row">
            <img src="uploads/local/books.ico" alt="">
            <img src="uploads/local/favorites v2.ico" alt="">
            <img src="uploads/local/fonts v2.ico" alt="">
            <img src="uploads/local/hot files.ico" alt="">
            <img src="uploads/local/locked.ico" alt="">
        </div>
        <h1>Videos</h1>
        <div class="row">
            <img src="uploads/local/books.ico" alt="">
            <img src="uploads/local/favorites v2.ico" alt="">
            <img src="uploads/local/fonts v2.ico" alt="">
            <img src="uploads/local/hot files.ico" alt="">
        </div>
    </div> --}}
    
@endsection