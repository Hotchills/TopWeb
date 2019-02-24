
<div class="row" style="border:0px solid black;">                        
    <div class="thumbnail">
        <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
    </div><!-- /thumbnail -->
    <div class="panel panel-com panel-default">
        <div class="panel-heading" style="margin:0px;padding:2px;padding-left:10px; ">
            <strong>{{$comment->user->name}}</strong><span class="text-muted"> - is the ID:{{$comment->id}}</span>
        </div>
        <div class="panel-body">
            @if (strlen(strip_tags($comment->body)) < 20)
            <div id="comment-body{{$comment->id}}" class="panel-body"> {!! $comment->body !!}</div>
            @else
            <div id="comment-body{{$comment->id}}" class="panel-body comment-body-short" Style="word-wrap: break-word;" >{!!substr($comment->body,0,20)!!}                             
            <span id="comment-body-full{{$comment->id}}" Style="display:none;">{!!substr($comment->body,20)!!} </span>
            
            <a class="comment-body-button" id="comment-body-button{{$comment->id}}">Read more</a>
            </div>
            @endif
            
            <div id="comment-edit{{$comment->id}}"class="form-inline" style="display:none;" >    
                {{Form::open(['route'=>'comment.edit','method'=>'PUT'])}}
                {{Form::hidden('commentid',$comment->id)}}
                {{Form::label('body','edit comment')}}
                {{Form::textarea('body',$comment->body,['class'=>'pb-cmnt-textarea'])}}
                {{Form::submit('Done',['class'=>'btn btn-warning pull-right btn-sm'])}}    
                {{ Form::close() }}
            </div>
        </div>
        <div class="panel-footer " style="margin:0px;padding:2px;">

            <div class="btn-group pull-right">   
                <button  type="button" class="btn btn-success up-comment btn-sm" id="up-vote-comment{{$comment->id}}"> <span id="nr-up-vote-comment{{$comment->id}}">{{$comment->upvotescomment()}} </span><span Style="color:white; ">&#8657 </span></button>
                <button  type="button" class="btn btn-danger down-comment btn-sm" id="down-vote-comment{{$comment->id}}" ><span id="nr-down-vote-comment{{$comment->id}}"> {{$comment->downvotescomment()}}</span> <span Style="color:white;">&#8659 </span></button>                   
            </div>
            @guest

            @else                         
            @if(Auth::user()->name != $comment->user->name)
            <button class="btn btn-primary btn-sm " onclick="show_commentreplay({{$comment->id}})">Replay</button>  
            @else
            <button id="comment-editbutton{{$comment->id}}" class="btn btn-danger  btn-sm" onclick="editcomment({{$comment->id}})">Edit</button>
            
 
                {{Form::open(['route'=>'comment.delete','method'=>'DELETE'])}}
                {{Form::hidden('commentid',$comment->id)}}
                {{Form::button('Delete',['type' => 'submit','class'=>'btn btn-danger btn-sm'])}}    
                {{ Form::close() }}
       
            @endif
            @endguest  

        </div>
    </div>  
</div>          

<a href="/{{$main}}/{{$page->name}}/{{$top->title}}" Style="float:right;color:grey;font-weight: bold;">View all replies &#10549;</a>