@extends('layouts.app')
@section('content')
    @include('admin.menu._nav')
    <p><a href="{{ route('admin.menu.create') }}" class="btn btn-success">Add page</a></p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Page</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($menus as $menu)
            <tr>
                <td>
                    @for ($i = 0; $i < $menu->depth; $i++) &mdash; @endfor
                    <a href="{{ route('admin.menu.show', $menu) }}">{{ $menu->title }}</a>
                </td>
                <td>
                    <a href="{{ route('page', page_path($menu->page)) }}"> {{ $menu->page->title }}</a>
                </td>
                <td>
                    <div class="d-flex flex-row">
                        <form method="POST" action="{{ route('admin.menu.first', $menu) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-up"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.menu.up', $menu) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-up"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.menu.down', $menu) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-down"></span></button>
                        </form>
                        <form method="POST" action="{{ route('admin.menu.last', $menu) }}" class="mr-1">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary"><span class="fa fa-angle-double-down"></span></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection