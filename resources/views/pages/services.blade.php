@extends('layout.app')

@section('content')

    <h1>{{ $title }}</h1>
    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts
        and visual mockups.</p>
    @if (count($services) > 0)
        <div class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">{{ $service }}</li>
            @endforeach
        </div>
    @endif
@endsection
