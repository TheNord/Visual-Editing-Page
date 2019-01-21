@extends('layouts.app')

@section('title')
    {{ $page->title }}
@endsection

@section('meta')
    @if ($page->hasDescription())
        <meta name="description" content="{{ $page->description }}">
    @endif
    @if ($page->hasKeywords())
        <meta name="keywords" content="{{ $page->keywords }}">
    @endif
@endsection

@section('content')
    <h1 class="mb-3">{{ $page->title }}</h1>

    @if ($page->children)
        <ul class="list-unstyled">
            @foreach ($page->children as $child)
                <li><a href="{{ route('page', page_path($child)) }}">{{ $child->title }}</a></li>
            @endforeach
        </ul>
    @endif
    <div data-editable data-name="main-content">
        {!! $page->content !!}
    </div>
@endsection