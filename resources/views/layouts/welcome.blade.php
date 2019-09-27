<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                background-color: #ccc;
                /* background-image: url("{{ url('/') }}/autom.jpg"); */
                opacity: 0.9;
            }

            .panel-title {
                display: inline;
            }

            tr td:first-child {
                font-weight: bold;
                width: 100px;
            }

            #scollDiv {
                max-height: 500px;
                overflow-y: scroll;
            }

            .container {
                margin-top: 20px;
            }

            .videoBG {
                /* position: fixed; z-index: 0; top: 0px; left: 0px; height: 3279px; width: 1903px; */
                /* opacity: 0.2; */
            }
            
        </style>
        <script>
            $(document).ready(function () {
                var name = prompt('Enter your name', 'guest');
                var myFirebase = new Firebase('https://fireb-b8686.firebaseio.com/');
                if (name) {
                $('#txtName').text(name);
                $('#btnSend').on('click', function (e) {
                    e.preventDefault();
                    var text = $('#txtText').val();
                    if (text) {
                    myFirebase.push({name: name, text: text}); 
                    $('#txtText').val('');
                    }
                });

                myFirebase.on('child_added', function (snapshot){
                    var message = snapshot.val();
                    var html = 
                        '<tr>' + 
                        '<td><i class="glyphicon glyphicon-user"></i> ' + message.name + ': </td>' + 
                        '<td>' + message.text + '</td>' + 
                        '</tr>';
                    $('#messageContainer tr:last').after(html);
                    $('#scollDiv').animate({
                    scrollTop: $('#scollDiv')[0].scrollHeight
                    }, 0);
                });
                } else {
                window.location.reload();
                }
            });
        </script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <i class="glyphicon glyphicon-user"></i>
                                    <h6 class="panel-title">ChatBox</h6>
                                    <div class="btn-group btn-group-xs pull-right">
                                        Hello, <span id="txtName"></span>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12" id="scollDiv">
                                            <table class="table table-hover" id="messageContainer">
                                                <tr></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <form>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-pencil"></i>
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
                    <h5 style="color: white;">Nghe Nhạc Vui vẻ</h5>
                    <audio controls>
                        <source src="{{ url('/') }}/audio.mp3" type="audio/mp3">
                        Your browser does not support the audio element.
                    </audio>
                    <br/><h2>Lão Hạc(part 1)</h2><br/>
                    <iframe width="600" height="400" src="https://www.youtube.com/embed/er_lC05fPwA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <br/><h2>Lão Hạc(part 2)</h2><br/>
                    <iframe width="600" height="400" src="https://www.youtube.com/embed/5V39cdKw9fc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                
            
        </div>
    </body>
</html>