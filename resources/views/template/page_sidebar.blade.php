{{-- #Template Name: Мой шаблон страницы# --}}

@extends('template.layouts.app')

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
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-3">Шаблон страницы со сайдбаром</h1>
            <div data-editable data-name="main-content">
                {!! $page->content !!}
            </div>
        </div>
        <div class="col-md-4" style="background-color: #F7D3D2; height: 800px;">
            <h2>Сайдбар</h2>
        </div>
    </div>
@endsection