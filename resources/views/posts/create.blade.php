@extends('layouts.app')

@section('content')
   {!! Form::open([ 'url' => 'posts' , 'method'=>"POST",'enctype'=>'multipart/form-data'] ) !!}
    <div class="form-group mb-3">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'Title']) }}
    </div>
    <div class="form-group mb-3">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['id'=>'ckeditor', 'class' => 'form-control', 'placeholder'=>'Insert post body']) }}
    </div>
    <div class="form-group mb-5">
        {{ Form::file("image") }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
