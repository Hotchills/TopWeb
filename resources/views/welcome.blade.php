@extends('layouts.app')

@section('content')


<div class="flex-center "Style='padding:20px;border:1px grey solid'>

    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>
        <div class="links">
            <h2>Create new mainpage: </h2> <a href="{{route('CreateMainPage')}}">Create new mainpage</a>
           


        </div>
        <br>
        <br>
        <br>
        <div class="links">
            <h2>View main pages :</h2>
            
                @foreach($mainpages as $mainpage)    
 
    <a href="/{{$mainpage->name}}">{{$mainpage->title}}</a>
    @endforeach 

        </div>
    </div>
</div>

@endsection