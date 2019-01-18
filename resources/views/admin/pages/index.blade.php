@extends('layouts.app')
@section('content')
    @include('admin.pages._nav')
    <p><a href="{{ route('admin.pages.create') }}" class="btn btn-success">Add page</a></p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                <td>
                    @for ($i = 0; $i < $page->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.pages.show', $page) }}">{{ $page->title }}</a>
                </td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection