@extends('layouts.app')
@section('content')
    @include('admin.menu._nav')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.menu.edit', $menu) }}" class="btn btn-primary mr-1">Edit</a>
        <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $menu->id }}</td>
        </tr>
        <tr>
            <th>Menu title</th>
            <td>{{ $menu->title }}</td>
        </tr>
        <tr>
            <th>Page</th>
            <td>
                <a href="{{ route('page', page_path($menu->page)) }}">{{ $menu->page->title }}</a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection