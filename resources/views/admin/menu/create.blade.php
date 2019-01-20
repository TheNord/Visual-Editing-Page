@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление меню
               </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавление нового пункта в верхнее меню</h3>
                    @include('admin.partials.errors')
                </div>
                {!! Form::open(['route' => 'admin.menu.store']) !!}
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="page" class="col-form-label">Page</label>
                            <select id="page" class="form-control"
                                    name="page_id">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}"{{ $page->id == old('page_id') ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $page->depth; $i++) &mdash; @endfor
                                        {{ $page->title }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="parent" class="col-form-label">Parent</label>
                            <select id="parent" class="form-control"
                                    name="parent">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->title }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-default">Назад</a>
                            <button class="btn btn-success pull-right">Добавить</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection