@extends('layouts.app')

@section('content')



<div style=" margin: auto;width: 50%;">

    <div class="form-inline">
        {{Form::open(['route'=>'mainpage.store','method'=>'POST'])}}
        {{Form::label('name','Name:')}}
        {{Form::text('name','',['class'=>'form-control'])}}
    </div>  
    <div class="form-inline">
        {{Form::label('title','Title:')}}
        {{Form::text('title','Title',['class'=>'form-control'])}}

    </div>           
    <div class="form-inline">
        {{Form::label('body','body:')}}
        {{Form::textarea('body','Body',['class'=>'form-control tinymxetextarea','rows'=>'7'])}}
    </div>
    {{Form::submit('Add main page',['class'=>'btn btn-primary'])}}    


    {{ Form::close() }}


</div>             
@endsection
