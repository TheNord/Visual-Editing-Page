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
            <h2>{{ $post->title }}</h2>
            <hr />

            @if($post->hasMiniature())
                <img src="{{ asset($post->miniature) }}" class="img-responsive " style="max-height:200px; float:left; padding-right: 15px">
            @endif                
            {{ $post->shortlyContent() }}

            <br /><br />
            <a href="{{ route('category.post.show', [$category, $post]) }}">Подробнее</a>
            <div class="clearfix"></div>
        @endforeach
    @else
        <p>В данной категории нет постов</p>
    @endif
@endsection