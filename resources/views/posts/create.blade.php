@extends('layout.app')

@section('content')
   {!! Form::open([ 'url' => 'posts' , 'method'=>"POST"] ) !!}
    <div class="form-group">
        {{ Form::label('title', 'title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'Title']) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder'=>'Insert post body']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
