@extends('layouts.app')

@section('content')

<div style=" margin: auto;width: 50%;">
<a> {{$Pageid}} </a>
    <div class="form-inline">
        {{Form::open(['route'=>'top.store','method'=>'POST'])}}

        {{Form::hidden('page_id',$Pageid)}}
    </div>

    <div class="form-inline">
        {{Form::label('title','Insert the Title:')}}
        {{Form::text('title','',['class'=>'form-control'])}}
    </div>
    <div class="form-inline">
        {{Form::label('body','Body info:')}}
        {{Form::textarea('body','',['class'=>'form-control tinymxetextarea','rows'=>'7'])}}
    </div>
    
   
    {{Form::submit('Add top',['class'=>'btn btn-primary'])}}    


    {{ Form::close() }}


</div>   

@endsection