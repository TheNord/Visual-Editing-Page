@extends('template.layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <h1 class="mb-3">{{ $post->title }}</h1>

    <p>Категория: {{ $category->name }}</p>
    <p>
    	Метки: 
    	@foreach($post->tags as $tag)
			{{ $tag->name }}
    	@endforeach
    </p>
    <p>Дата публикации: {{ $post->created_at }}</p>

    {!! $post->content !!}
    
    <a href="{{ route('category', $category->slug) }}">Назад</a>
@endsection