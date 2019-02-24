

<div class="showtops row" id="clickdoc" Style="position:relative; border:1px solid black;padding:0px;margin: 0px;">


    <div class="col-xs-6" style="border:0px solid red;padding:0px;margin: 0px;">

        @foreach($tops as $top)    

        <div id="top_nr{{$top->id}}" class="top-heading" Style="font-size: 14px;padding-bottom: 0px;">  
            <div class="row">
                <div class="col-md-4">
                    <img  Style="border:1px solid black;" src="{{$top->movie->poster_path}}">
                </div>
                <div class="col-md-7"Style="right:-40px;top:-20px">
                    <h3><strong>{{$top->movie->title}}</strong></h3>                     
                    <ul class="list-group">
                         <li class="list-group-item"><strong>TMDBid:</strong> {{$top->movie->TMDBid}}</li>
                        <li class="list-group-item"><strong>Released:</strong> {{$top->movie->release_date}}</li>
                        <li class="list-group-item"><strong>Rated:</strong> {{$top->movie->vote_average}} from {{$top->movie->vote_count}}  <a href="" target="_blank" class="btn btn-warning btn-sm">IMDB</a></li>
                        <li class="list-group-item"><strong><a href="/{{$main}}/{{$page->name}}/{{$top->title}}"> View page</strong> </a></li>

                    </ul>
                    <div class="btn-group">   
                        <button  type="button" class="btn btn-success up-top btn-sm" id="up-vote-top{{$top->id}}"><span id="nr-up-vote-top{{$top->id}}">{{$top->upvotestop()}} </span><span Style="color:white; ">&#8657 </span></button>
                        <button  type="button" class="btn btn-danger down-top btn-sm" id="down-vote-top{{$top->id}}"><span id="nr-down-vote-top{{$top->id}}"> {{$top->downvotestop()}}</span> <span Style="color:white;">&#8659 </span></button>                   
                    </div>
                    
                </div> 
            </div>
          
            <div  class="row">
                <div class="well well-sm">
                    <h3>Plot</h3>
                    {{$top->movie->overview}}
                </div>
            </div>
        </div>
        <div class="commentid col-xs-6 " Style="padding-right: 0px;">
            <div id="idi{{$top->id}}" class="ascunde" >
                <div class="row">
                    <div class="col-xs-12">
                        <p>{{$top->movie->title}}</p>  
                    </div></div>

                <div class="row ">
                    <div class="col-xs-12" style="border:0px solid black;padding:0px;margin:0px;">

                        @guest
                        <p> Please login to add comment</p>
                        @else                         

                        <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#ds{{$top->id}}" aria-expanded="false" aria-controls="ds{{$top->id}}">add a new comment {{Auth::user()->name}}</button>
                        <div id="ds{{$top->id}}" class="newcommentarea collapse" >                        
                            <div class="row panel-comment" style="margin:0px;padding:8px; padding-left:0px;padding-right: 0px;top:0px;left:0px;">
                                <div class="col-xs-12">
                                    {{ Form::open(['route'=>['comment.store',$top->id],'method'=>'POST'])}}                               
                                    {{Form::textarea('body','Comment',['class'=>'pb-cmnt-textarea'])}}<br>

                                    <div class="form-inline">
                                        {{Form::submit('Comment',['class'=>'btn btn-primary'])}}    
                                    </div>
                                    {{ Form::close() }} 
                                </div>
                            </div>
                        </div>  
                        @endguest  
                    </div></div>

                <section class="ShowCommentsClass">

             <ul id="myTabMovie" class="nav nav-tabs" role="tablist">
                            <li class="active" > <a data-toggle="pill" href="#Default">Default</a></li>
                            <li> <a data-toggle="pill" href="#ByUpVote">by Up Vote</a></li>
                            <li> <a data-toggle="pill" href="#ByDownVote">by Down Vote</a></li>
                        </ul>

                        <div class="button_comments_Default" id="button_comments_Default{{$top->id}}" ></div>
                        <div class="button_comments_UpVote" id="button_comments_UpVote{{$top->id}}" ></div> 
                        <div class="tab-content">
                            <div id="Default" class="tab-pane fade in active">
                                <?php $comments = $top->show(); ?>
                                @foreach($comments as $comment)
                                <br>
                                @include('layouts.CommentTemplate')
                                <br>
                                @endforeach                       
                            </div>   

                            <div id="ByUpVote" class="tab-pane fade">
                                <?php $comments1 = $top->showUpVote(); ?>
                                @foreach($comments1 as $comment)
                                <br>
                                @include('layouts.CommentTemplate')
                                <br>
                                @endforeach 
                            </div> 


                            <div id="ByDownVote" class="tab-pane fade">
                                <?php $comments2 = $top->showDownVote(); ?>
                                @foreach($comments2 as $comment)
                                <br>
                                @include('layouts.CommentTemplate')
                                <br>
                                @endforeach 
                            </div> 

                        </div>
                        
                                    <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#ds{{$top->id}}" aria-expanded="false" aria-controls="ds{{$top->id}}"><a href="#clickdoc" style="color: white;">New comment</a></button>

                </section>

            </div>
        </div>
        <br>
        @endforeach 
        {{ $tops->links() }}
    </div>
