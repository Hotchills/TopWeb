@extends('layouts.app')

@section('content')

<h1>General Account Settings</h1>
<table class="table">
    <tbody>
        <tr>
            <td class="col-md-4"> User ID</td>
            <td> {{Auth::id()}}</td>

        </tr>
        <tr>
            <td class="col-md-4">User name</td>
            <td> {{Auth::user()->name}}</td>
        </tr>
        <tr>
            <td class="col-md-4">User email</td>
            <td> {{Auth::user()->email}}</td>
        </tr>

        @if (Auth::user()->userprofile) 
        <tr> 
            <td class="col-md-4"> UserProfile ID</td>
            <td>  {{Auth::user()->userprofile->id}}</td>
        </tr>
        <tr>
            <td class="col-md-4"> Overview</td>
            <td>{{Auth::user()->userprofile->overview}}</td>
        </tr>
        <tr>
            <td class="col-md-4"> Country</td>
            <td>{{Auth::user()->userprofile->country}}</td>
        </tr>
        <tr>
            <td class="col-md-4">  Nr of Tops</td>
            <td>{{Auth::user()->userprofile->nr_tops}}</td>
        </tr>
        <tr>
            <td class="col-md-4">Nr of Comments</td>
            <td>   {{Auth::user()->userprofile->nr_comments}}</td>
        </tr>


        @else

    <div style=" margin: auto;width: 50%;">


        <div class="form-inline">
            {{Form::open(['route'=>'profileinfo.store','method'=>'POST'])}}
            {{Form::label('country','country:')}}

            {{ Form::select('country', array(
'Select a Country' => 'Select a Country',
'Ascension Island' => 'Ascension Island',
'Andorra' => 'Andorra',
'United Arab Emirates' => 'United Arab Emirates',
'Afghanistan' => 'Afghanistan',
'Antigua And Barbuda' => 'Antigua And Barbuda',
'Anguilla' => 'Anguilla',
'Albania' => 'Albania',
), 'country', ['class' => 'form-control', 'name' => 'country']) }}

        </div>  

        {{Form::submit('Addcountry',['class'=>'btn btn-primary'])}}    
        {{ Form::close() }}

        <div class="form-inline">
            {{Form::open(['route'=>'profileinfo.store','method'=>'POST'])}}

            {{Form::label('overview','overview:')}}
            {{ Form::textarea('overview','overview')}}
        </div>         
        {{Form::submit('Addoverview',['class'=>'btn btn-primary', 'name' => 'overview'])}}    
        {{ Form::close() }}


    </div> 

</tbody>
</table>
@endif


@endsection