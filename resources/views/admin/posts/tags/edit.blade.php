@extends('admin.layout', ['page' => 'tags'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление метками
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="col-md-12">     
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактирование метки</h3>
                    @include('admin.partials.errors')
                </div>
                {{ Form::open([
                        'route' =>  ['admin.posts.tags.update', $tag->slug],
                        'method' => 'put']
                        ) }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input name="name" type="text" class="form-control" value="{{ $tag->name }}">
                        </div>

                        <div class="form-group">
                            <label for="slug">Слаг (Url)</label>
                            <input name="slug" type="text" class="form-control" value="{{ $tag->slug }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-default">Назад</a>
                        <button class="btn btn-success pull-right">Сохранить</button>
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