@extends('layouts.app')

@section('content')

<div id="tag" class="firstmain">


    <div class="flex-center">
        <h2 >
            Page name :{!! $page->title !!} 
        </h2></div>
       <div class="flex-center">
        <div class="panel-heading"><p>  Main page : {!! $page->mainpage->name !!}  Title : {{$page->title}}</p>
        </div>
    </div>
    <div Style="word-wrap: break-word;">
    {!! $page->body !!}
     </div>
    <br>

    <section class="ShowTopsClass">
    @if($page->page_type == 0)
        @include('TopsPage')
        @endif
    @if($page->page_type == 1)
        @include('MoviesTopsPage')
       @endif
    </section>

    <br>
    @if($page->page_type == 0)
    <a href="{{route('CreateTop',['main'=> $page->mainpage->name ,'page' => $page->name ])}}">CreateTop</a>
    @endif
    @if($page->page_type == 1)
    <a href="{{route('AddMovieInDB',['main'=> $page->mainpage->name ,'page' => $page->name ])}}">AddMovie</a>
    @endif
</div>

@endsection