@extends('layouts.app')

@section('content')
    @push('head')
        <!-- Scripts -->
        <script type="text/javascript">
            $(document).ready(function () {
                function convert(text)
                {
                    var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
                    var text1=text.replace(exp, "<a target='_blank' href='$1'>$1</a>");
                    var exp2 =/(^|[^\/])(www\.[\S]+(\b|$))/gim;
                    var result =text1.replace(exp2, '$1<a target="_blank" href="http://$2">$2</a>');
                    return result;
                }
                var myFirebase = new Firebase('https://fireb-b8686.firebaseio.com/');
                var ids_admin_group = [1,2];
                var name = $('#name_user').val();
                var role_id = $('#role_id').val();

                $('#btnSend').on('click', function (e) {
                    e.preventDefault();
                    var text = $('#txtText').val();
                    if (text) {
                        myFirebase.push({name: name, text: text, role_id: role_id}); 
                        $('#txtText').val('');
                    }
                });

                myFirebase.on('child_added', function (snapshot){
                    var message = snapshot.val();
                    var style = '';
                    var role_id = parseInt(message.role_id);
                    if(ids_admin_group.includes(role_id)){
                        style = 'style="color:' + ' blue"';
                    }
                    var html = 
                        '<tr class="list-inline chat">' + 
                        '<td class="list-inline-item" '+ style +'><i class="fas fa-user"></i> ' + message.name + ': </td>' + 
                        '<td class="list-inline-item">' + convert(message.text) + '</td>' + 
                        '</tr>';
                    $('#messageContainer tr:last').after(html);
                    
                    $('#scollDiv').animate({
                        scrollTop: $('#scollDiv')[0].scrollHeight
                    }, 0);
                });


            });
        </script>
    @endpush
    
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border border-primary">
                        <div class="card-header bg-primary">
                            <div class="btn-group btn-group-xs float-left">
                                Chat All
                            </div>
                            <div class="btn-group btn-group-xs float-right">
                                <i class="fas fa-user mr-1 mt-1"></i>
                                Hello, <span id="txtName">
                                    @guest
                                        Guest
                                    @else
                                        {{ Auth::user()->name }}
                                    @endguest
                                </span>
                                <input id="name_user" type="hidden" value="{{ Auth::user()->name ?? 'Guest' }}">
                                <input id="role_id" type="hidden" value="{{ (Auth::user() != null) ? Auth::user()->roles()->pluck('id')->first() : 'null' }}">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12" id="scollDiv">
                                    <table class="table table-hover" id="messageContainer">
                                        <tr></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="txtText"
                                        placeholder="Type your message here ..">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"
                                            id="btnSend">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fingerprint-spinner">
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            <div class="spinner-ring"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h5><strong>Nghe Nhạc Vui vẻ</strong></h5>
            <audio controls>
                <source src="{{ url('/') }}/audio.mp3" type="audio/mp3">
                Your browser does not support the audio element.
            </audio>
            <br/><br/><h2>Lão Hạc(part 1)</h2>
            <iframe width="600" height="400" src="https://www.youtube.com/embed/er_lC05fPwA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <br/><br/><h2>Lão Hạc(part 2)</h2>
            <iframe width="600" height="400" src="https://www.youtube.com/embed/5V39cdKw9fc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <iframe width="600" height="400" src="https://www.youtube.com/embed/1wm0vfPoO1Q" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/cpcKEfaglWk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
            {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/wSxijea-o_M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
            {{-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample">
                Gái Xinh
            </button> --}}
            <div class="collapse mt-5" id="collapseExample">
                {{-- <img src="{{ url('/') }}/gai.jpg" alt="Italian Trulli"> --}}
                {{-- <video autoplay loop>
                    <source src="{{ url('/') }}/IMG_2755.mp4" type="video/mp4">
                </video> --}}
            </div>
        </div>
        
    </div>
        
    {{-- <div class="videoBG">
        <video autoplay muted loop>
            <source src="{{ url('/') }}/background_autumn.mp4" type="video/mp4">
        </video>
    </div> --}}
    {{-- <div class="col-md-6 col-md-offset-3">
        <video autoplay loop>
                <source src="{{ url('/') }}/IMG_2755.mp4" type="video/mp4">
        </video>
    </div> --}}
    {{-- <div class="col-md-4 col-md-offset-3">
        <center><img src="{{ url('/') }}/photo_2019-09-24_16-26-18.jpg" alt="Italian Trulli"></center>
    </div>
    <div class="col-md-4 col-md-offset-3">
        <center><img src="{{ url('/') }}/1.jpg" alt="Italian Trulli"></center>
    </div>
    <div class="col-md-4 col-md-offset-3">
        <center><img src="{{ url('/') }}/2.jpg" alt="Italian Trulli"></center>
    </div> --}}
    {{-- <div class="col-md-4 col-md-offset-3">
        <center><img src="{{ url('/') }}/photo_2019-09-24_16-26-18.jpg" alt="Italian Trulli"></center>
    </div> --}}
@endsection
