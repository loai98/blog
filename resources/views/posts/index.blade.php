@extends('layouts.app')

@section('content')

    @auth
        <a class="btn btn-primary mb-5" href="/posts/create">Add new post</a>
    @endauth

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <h2 class="card-header">
                    {{ $post->title }}
                </h2>
                <div class="card-body">
                    <small>{{ $post->created_at }}</small>
                    <p class="card-text">{{ $post->body }}</p>

                    <div class="d-flex justify-content-between">
                        <a href="posts/{{ $post->id }}" class="btn btn-primary">View More</a>
                        @auth
                            @if (auth()->user()->id == $post->user_id)
                                {!! Form::open(['url' => 'posts/' . $post->id, 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {!! Form::close() !!}
                            @endif
                        @endauth

                    </div>

                </div>
            </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @endif

@endsection
