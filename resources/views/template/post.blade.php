@extends('template.layouts.app')

@include('template.layouts.meta', ['data' => $post])

@section('content')
    <h1 class="mb-3">{{ $post->title }}</h1>

    <p>Категория: {{ $category->name }}</p>

    @if($post->hasTags())
    <p>
    	Метки: 
    	@foreach($post->tags as $tag)
			{{ $tag->name }}
    	@endforeach
    </p>
    @endif

    <p>Дата публикации: {{ $post->created_at }}</p>

    {!! $post->content !!}
    
    <a href="{{ route('category.index', $category->slug) }}">Назад</a>
@endsection