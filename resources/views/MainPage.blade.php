@extends('layouts.app')

@section('content')
<div class="firstmain">

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <br>


    <div class="flex-center">
        <h2 >
            Page name : {{$mainpage->name}}
        </h2></div>
    
    
    <div class="panel panel-info">
        <div class="panel-heading"><p>Page title : {{$mainpage->title}}</p></div>
        <div class="panel-body" Style="word-wrap: break-word;" ><p>Page Body :</p> {!!$mainpage->body!!}</div>
    </div>
    <br>
    <h3>Pages on this category:</h3>
    <br>

    <table class="table" Style="width: 70%;">
    <tbody>

    @foreach($pages as $page)   
    <tr>
            <td class="col-md-4"> 
    <a href="/{{$mainpage->name}}/{{$page->name}}">{{$page->title}}</a>
    {{substr(strip_tags($page->body),0,100)}} 
    @if (strlen(strip_tags($page->body)) > 100)     
         <a href="/{{$mainpage->name}}/{{$page->name}}">...</a>        
    @endif
   
    </td>
    </tr>
    

    @endforeach 
    <tr><td></td></tr>
    </tbody>
</table>
    
    
    
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <a href="{{route('CreatePage',['main'=>$mainpage->name])}}">CreatePage</a>
</div>
@endsection
