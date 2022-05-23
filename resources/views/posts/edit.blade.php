@extends('layouts.app')

@section('content')
   {!! Form::open([ 'url' => 'posts/'.$post->id , 'method'=>"PUT" ,'enctype'=>'multipart/form-data'] ) !!}
    <div class="form-group">
        {{ Form::label('title', 'title') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder'=>'Title']) }}
    </div>
    <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', $post->body, ['id'=>'ckeditor', 'class' => 'form-control', 'placeholder'=>'Insert post body']) }}
    </div>
    <div class="form-group mb-5">
        {{ Form::file('image') }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection
