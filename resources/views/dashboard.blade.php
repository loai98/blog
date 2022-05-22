@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="posts/create" class="btn btn-primary">Creat post</a>
                    </div>
                </div>

                @if (count($posts) > 0)
                    @foreach ($posts as $post)
                        <div class="card mb-3">

                            <div class="card-header">{{ $post->title }}</div>
                            <div class="card-body">
                                <div class="body">{!! $post->body !!}</div>
                                <small>{{ $post->created_at }}</small>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="posts/{{ $post->id }}" class="btn btn-primary">View More</a>
                                {!! Form::open(['url' => 'posts/' . $post->id, 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {!! Form::close() !!}
                            </div>

                        </div>
                    </div>

                    @endforeach
                @endif
            </div>

        </div>
    @endsection
