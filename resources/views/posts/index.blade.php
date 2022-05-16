@extends('layout.app')

@section('content')

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card mb-3">
                <h2 class="card-header">
                    {{ $post->title }}
                </h2>
                <div class="card-body">
                    <small>{{$post->created_at}}</small>
                  <p class="card-text">{{$post->body}}</p>
                  <a href="posts/{{$post->id}}" class="btn btn-primary">View More</a>
                </div>
              </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @endif

@endsection
