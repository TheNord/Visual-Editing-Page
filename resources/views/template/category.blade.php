@extends('template.layouts.app')

@section('title')
    {{ $category->name }}
@endsection

@section('meta')
    @if ($category->hasDescription())
        <meta name="description" content="{{ $category->description }}">
    @endif
@endsection

@section('content')
    <h1 class="mb-3">Категория: {{ $category->name }}</h1>

    @if ($category->hasDescription())
        <p>{{ $category->description }}</p>
    @endif

    @if ($category->hasPosts())
        @foreach($category->posts as $post)
            {{ $post->title }}
            {!! $post->content !!}
            <a href="{{ route('category.post.show', [$category, $post]) }}">Подробнее</a>
        @endforeach
    @else
        <p>В данной категории нет постов</p>
    @endif
@endsection