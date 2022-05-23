@extends('layouts.app')


@section('content')

<div class="post mb-5">
    <h1>{{ $post->title }}</h1>
    @if ($post->image)

    <img src = '/storage/images/{{$post->image}}' width="100%">
        
    @endif
    <p>{!! $post->body !!}</p>
    <small>{{$post->created_at}}</small>
</div>

@auth
@if (auth()->user()->id == $post->user_id)
    
<div class="actions d-flex justify-content-between">
    <a class="btn btn-primary" href="/posts/{{$post->id}}/edit">Edit</a>
    {!! Form::open([ 'url' => 'posts/'.$post->id , 'method'=>"DELETE"] ) !!}
    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
</div> 
@endif

@endauth


@endsection