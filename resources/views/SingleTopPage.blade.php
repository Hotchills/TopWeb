@extends('layouts.app')

@section('content')


      
<a href="/{{$main}}/{{$page->name}}"> Back to page </a>
                     
            <h1>{{$toptemp->title}}</h1>            
            <br>
            <p >{{$toptemp->body}}</p>               
       
                <div class="row">
                    <div class="col-xs-12">
                        <h1>{{$toptemp->title}}</h1>  
                    </div></div>

                <div class="row">
                    <div class="col-xs-12" style="border:1px solid black;padding:0px;margin:0px;">

                        @guest
                        <p> Please login to add comment</p>
                        @else                         

                        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#ds{{$toptemp->id}}" aria-expanded="false" aria-controls="ds{{$toptemp->id}}">add a new comment {{Auth::user()->name}}</button>
                        <div id="ds{{$toptemp->id}}" class="newcommentarea collapse" >                        
                            <div class="row panel" style="margin:0px;padding:8px; padding-left:0px;padding-right: 0px;top:0px;left:0px;">
                                <div class="col-xs-12">
                                    {{ Form::open(['route'=>['comment.store',$toptemp->id],'method'=>'POST'])}}                               
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
                <?php $comments = $toptemp->show();
               $top = $toptemp;
                
                ?>

                <section class="ShowCommentsClass">

                    @include('CommentsPage')

                </section>

        
@endsection