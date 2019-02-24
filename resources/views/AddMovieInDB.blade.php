@extends('layouts.app')

@section('content')

<p>Add movie to TOP : {{$main}}{{$page}} </p>

<input class="form-control" Style="width: 50%;" id="moviesearch" type="text" />
<button class="btn btn-primary" id="moviesearchbutton">Search</button>


<!-- Content here -->
<ul class="row container-fluid" id="show-movies" >

</ul>   

<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script> 
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script>

$(document).ready(function () {
var url = 'http://api.themoviedb.org/3/',
        mode = 'search/movie?query=',
        input,
        movieName,
        key = '&api_key=8a8c4cbf7c68bc874accbfd9e83cee45';
$(".movies").click(function () {
var contentPanelId = $(this).attr("id");
console.log(contentPanelId);
});
$('#moviesearchbutton').click(function () {
var array = [];
var input = $('#moviesearch').val(),
        movieName = encodeURI(input);
$.ajax({
type: 'GET',
        url: url + mode + input + key,
        async: false,
        jsonpCallback: 'testing',
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function (json) {
        console.dir(json);
        $.each(json.results, function (i, movie) {
        var $li = $('<li id="firstpage' + i + '" class="movies col-sm-12 col-md-12 container" ></li>');
        $p = $('<div class="col-sm-8  text-center" Style="color:black;"><h2 class="row" > (' + movie.release_date + ') ' + movie.title + '</h2> <p>' + movie.overview + '</p></div> <button class="movieaddbutton btn btn-success col-sm-2 " id="firstpage' + i + '">AddMovie</button>');
        $img = $('<img class="col-sm-2 col-md-2" Style="margin:1px black;" src="">');
        if (movie.poster_path !== null) {
        $img.attr("src", "http://image.tmdb.org/t/p/w154/" + movie.poster_path);
        } else {
        $img.attr("src", "http://www.bookmysports.com/angular/assets/images/no_image.jpg");
        }
        $li.append($img);
        $li.append($p);
        array.push($li);
        });
        $("#show-movies").html(array);
        $(".movieaddbutton").click(function () {
        var contentPanelId = $(this).attr("id");
        numberobj = contentPanelId.slice(9);
        console.log(numberobj);
        var TMDBid = json.results[numberobj].id;
        var title = json.results[numberobj].title;
        var poster_path = 'http://image.tmdb.org/t/p/w154/' + json.results[numberobj].poster_path;
        var release_date = json.results[numberobj].release_date;
        var overview = json.results[numberobj].overview;
        var vote_average = json.results[numberobj].vote_average;
        var vote_count = json.results[numberobj].vote_count;
        var page_id = {{$Pageid}};
        var user_id = {{Auth::id()}};
        console.log(page_id);
        //console.log(json.results[numberobj].id);
        //   console.log(json.results[numberobj].title);
        //   console.log(poster_path);
        //   console.log(json.results[numberobj].release_date);
        //  console.log(json.results[numberobj].overview);
        //  console.log(json.results[numberobj].vote_average);
        //  console.log(json.results[numberobj].vote_count);

        $.ajax({
        method: "POST",
                url: 'http://127.0.0.1:8000/StoreMovietTop',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                //  data: {savedmovie: JSON.stringify(savedmovie)}
                data: { user_id:user_id, page_id:page_id, TMDBid: TMDBid, title:title, poster_path:poster_path, release_date:release_date, overview:overview, vote_average:vote_average, vote_count:vote_count  }
        })
                .done(function (data) {
                console.log(data.msg);
                console.log(data['message']);
                if (data.errors){
                jQuery.each(data.errors, function(key, value){
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>' + value + '</p>');
                });
                } else{
                window.location = 'http://127.0.0.1:8000/{{$main}}/{{$page}}';
                }
                })
                .fail(function (data) {
                console.log(data.msg);
                console.log(data);
                });
        // window.location = 'http://127.0.0.1:8000/{{$main}}/{{$page}}';
        // document.location.reload(true);
        });
        },
        error: function (data) {
        console.log(data.message);
        }
});
});
});
</script>


@endsection