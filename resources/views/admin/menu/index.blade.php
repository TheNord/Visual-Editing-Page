@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление меню
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="main-table" class="table table-bordered table-striped offsort">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Страница</th>
                            <th>Позиция</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>
                                    @for ($i = 0; $i < $menu->depth; $i++) &mdash; @endfor
                                    {{ $menu->title }}
                                </td>
                                <td>
                                    @if($menu->type == 0)
                                    <a href="{{ route('page', page_path($menu->page)) }}"> {{ $menu->page->title }}</a>
                                    @else
                                    <a href="{{ route('category.index', $menu->category) }}"> {{ $menu->category->name }}</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <form method="POST" action="{{ route('admin.menu.first', $menu) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary move"><span class="fa fa-angle-double-up"></span></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.menu.up', $menu) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary move"><span class="fa fa-angle-up"></span></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.menu.down', $menu) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary move"><span class="fa fa-angle-down"></span></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.menu.last', $menu) }}" class="mr-1">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary move"><span class="fa fa-angle-double-down"></span></button>
                                        </form>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.menu.edit', $menu->id) }}" class="fa fa-pencil fl"></a>
                                    {{ Form::open(['route' => ['admin.menu.destroy', $menu->id], 'method'=>'delete']) }}
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection