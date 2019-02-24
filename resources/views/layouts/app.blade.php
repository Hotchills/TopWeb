<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TipTop</title>

        <!-- CSRF Token -->

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />

        <!-- tinymce -Editor  -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pr6pj7rmersy5v4ymrd94bcw081ugpp9u9cg7yufsfr1rjvg"></script>
        <script>tinymce.init({selector: '.tinymxetextarea', menubar: false});</script>
        <style>
            <!-- Styles laravel welocome page-->

            html, body {

                background-color: #fff;
                color: #636b6f;

                font-weight: 100;
                height: 100vh;
                margin: 0;
                font-size: 16px;
            }
            .navbar-brand{
                font-size: 24px;
                color: black;

            }
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 18px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }


            <!-- Styles menu style-->     

            .navbar-nav>li>.dropdown-menu {
                border-top-left-radius:4px;
                border-top-right-radius:4px;
            }
            .navbar-default .navbar-nav>li>a {
                font-weight:bold;	
            }

            .mega-dropdown {
                position: static !important;
                display: block;
            }
            .mega-dropdown-menu {
                padding: 20px 0px;
                width: 100%;
                box-shadow: none;
                -webkit-box-shadow: none;
            }

            .mega-dropdown-menu > li > ul {
                padding: 0;
                margin: 0;
            }
            .mega-dropdown-menu > li > ul > li {
                list-style: none;
            }
            .mega-dropdown-menu > li > ul > li > a {
                display: block;
                padding: 3px 20px;
                clear: both;
                font-weight: normal;
                line-height: 1.428571429;
                color: #999;
                white-space: normal;
            }
            .mega-dropdown-menu > li ul > li > a:hover,
            .mega-dropdown-menu > li ul > li > a:focus {
                text-decoration: none;
                color: #444;
                background-color: #f5f5f5;
            }

            .mega-dropdown-menu .dropdown-header {
                color: #428bca;
                font-size: 24px;
                font-weight:bold;
            }
            .mega-dropdown-menu form {
                margin:3px 20px;
            }
            .mega-dropdown-menu .form-group {
                margin-bottom: 3px;
            }

            .vertical-align {
                display: flex;
                align-items: center;
            }

            .ascunde {    
                border-radius: 5px;
                border:1px solid grey;
                cursor: default;
                display: none;
                right:0px;
                top:0px;
                padding:20px;
            }

            .afiseaza {
                display:block;
                right:0px;
            }
            .top-heading{
                width: 100%;
                position:relative;
                border-radius:5px;
                padding:20px;
                background: white;
                height:auto;
                font-size:24px;
                color:black;
                border:1px solid #C0C0C0;     
            }

            .top-heading:hover{
                cursor: pointer;

            }

            .pb-cmnt-textarea {
                resize: none;
                padding: 10px;
                height: 130px;
                width: 100%;
                border: 1px solid #F2F2F2;
            }
            .thumbnail {
                padding:0px;
                width:13%;
                float:left;

            }
            .panel-com {
                height: 100%;
                position:relative;
                left:15px;
                top:10px;
                padding:0px;
                width:85%;
                float:left;
            }
            .panel-comment{
                height: 100%;
                position:relative;
                left:15px;
                top:10px;
                padding:0px;
                width:100%;
                float:left;
            }
            .panel-com>.panel-heading:after,.panel-com>.panel-heading:before{
                position:absolute;
                top:11px;left:-16px;
                right:100%;
                width:0;
                height:0;
                display:block;
                content:" ";
                border-color:transparent;
                border-style:solid solid outset;
                pointer-events:none;
            }
            .panel-com>.panel-heading:after{
                border-width:7px;
                border-right-color:#f7f7f7;
                margin-top:1px;
                margin-left:2px;
            }
            .panel-com>.panel-heading:before{
                border-right-color:#ddd;
                border-width:8px;
            }

            @media (max-width: 768px) {
                .btn {
                    padding:2px 4px;
                    font-size:80%;
                    line-height: 1;
                }
            }

            @media (min-width: 769px) and (max-width: 992px) {
                .btn {
                    padding:4px 9px;
                    font-size:90%;
                    line-height: 1.2;
                }
            }
            <!-- Styles laravel add movie in DB -->

            #show-movies{
                list-style-type: none;
                height: auto;
            }

            #show-movies li{		
                background:#F0F0F0;
                min-height:250px;
                border:solid 0.1px grey;
                padding:10px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3); 
                overflow:hidden;
                box-shadow: 1px 1px 5px 5px #E8E8E8 inset;
            }

            .movies{
                margin:5px; height:150px;overflow-wrap: break-word;
            }
        </style>
    </head>
    <body>
        <div class="container" Style="">
            <div class="jumbotron" Style="margin:0px;">
                <h1> Welcome to DO YOUR TOP Beta </h1> 
            </div>
            @include('layouts.menu')  
        </div>


        <div class="container">
            <main style="padding:10px;border:1px solid Gainsboro;border-radius: 5px;">

                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="alert alert-danger" style="display:none"></div>
                @yield('content')

            </main>

        </div>


        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script> 
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <!--  <script src="bootstrap-hover-dropdown.min.js"></script> -->

        <script>
$(document).ready(function () {


    $(".commentid").detach().appendTo("#clickdoc");

    $('#clickdoc').on('click', '.top-heading', function () {
        var i = Number(this.id.slice(6));
        show(i);
    });

    $('.up-comment').click(function () {
        var id = Number($(this).attr('id').slice(15));
        upvotecomment(id);
    });
    $('.down-comment').click(function () {
        var id = Number($(this).attr('id').slice(17));
        downvotecomment(id);
    });
    $('.up-top').click(function () {
        var id = Number($(this).attr('id').slice(11));
        //   console.log(id);
        upvotetop(id);
    });
    $('.down-top').click(function () {
        var id = Number($(this).attr('id').slice(13));
        //   console.log(id);
        downvotetop(id);
    });
    $('.comment-body-button').click(function () {
        var id = Number($(this).attr('id').slice(19));
        // console.log(id);
        showfullcomment(id);
    });

});


function show(id) {
    var allDivs = document.getElementsByClassName('ascunde');
    var Divs = document.getElementsByClassName('top-heading');
    for (var i = 0; i < allDivs.length; i++) {
        allDivs[i].classList.remove('afiseaza');
    }
    document.getElementById('idi' + id).classList.add('afiseaza');

    for (var j = 0; j < Divs.length; j++) {
        Divs[j].style.backgroundColor = "white";
    }
    document.getElementById('top_nr' + id).style.backgroundColor = "#C0C0C0";

}

function upvotecomment(temp) {

    // document.getElementById('up_vote_comment' + temp).innerHTML = vote + 1;

    var commentid = temp;

    $.ajax({
        method: "POST",
        url: 'http://127.0.0.1:8000/incrementvote',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {commentid: commentid}
    })
            .done(function (data) {
                console.log('merge');
                console.log(data['likes']);
                var likes = data['likes'];
                document.getElementById('nr-up-vote-comment' + temp).innerHTML = likes;
                console.log(data['dislikes']);
                var dislikes = data['dislikes'];
                document.getElementById('nr-down-vote-comment' + temp).innerHTML = dislikes;
            });
}

function downvotecomment(temp) {

    //  document.getElementById('down_vote_comment' + temp).innerHTML = vote + 1;

    var commentid = temp;

    $.ajax({
        method: "POST",
        url: 'http://127.0.0.1:8000/decrementvote',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {commentid: commentid}
    })
            .done(function (data) {
                // console.log(data['message']);
                console.log(data['likes']);
                var likes = data['likes'];
                document.getElementById('nr-up-vote-comment' + temp).innerHTML = likes;
                console.log(data['dislikes']);
                var dislikes = data['dislikes'];
                document.getElementById('nr-down-vote-comment' + temp).innerHTML = dislikes;

            });
}
function upvotetop(temp) {

    var topid = temp;
    console.log(topid);
    $.ajax({
        method: "POST",
        url: 'http://127.0.0.1:8000/incrementvotetop',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {topid: topid}
    })
            .done(function (data) {
                var likes = data['likes'];
                document.getElementById('nr-up-vote-top' + temp).innerHTML = likes;
                //  console.log(data['dislikes']);
                var dislikes = data['dislikes'];
                document.getElementById('nr-down-vote-top' + temp).innerHTML = dislikes;
            });
}

function downvotetop(temp) {

    var topid = temp;
    console.log(topid);
    $.ajax({
        method: "POST",
        url: 'http://127.0.0.1:8000/decrementvotetop',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {topid: topid}
    })
            .done(function (data) {
                var likes = data['likes'];
                document.getElementById('nr-up-vote-top' + temp).innerHTML = likes;
                //  console.log(data['dislikes']);
                var dislikes = data['dislikes'];
                document.getElementById('nr-down-vote-top' + temp).innerHTML = dislikes;
            });
}

function editcomment(temp) {

    document.getElementById('comment-body' + temp).style.display = "none";
    document.getElementById('comment-edit' + temp).style.display = "block";
    document.getElementById('comment-editbutton' + temp).style.display = "none";

}
function showfullcomment(temp) {
    document.getElementById('comment-body-button' + temp).style.display = "none";
    document.getElementById('comment-body-full' + temp).style.display = "block";

}

        </script>
    </body>
</html>
