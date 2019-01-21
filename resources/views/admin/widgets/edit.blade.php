@extends('admin.layout', ['page' => 'components'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление виджетами
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактирование виджета</h3>
                    @include('admin.partials.errors')
                </div>
                {{ Form::open([
                        'route' =>  ['admin.widgets.update', $widget->id],
                        'method' => 'put']
                        ) }}
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $widget->name }}">
                        </div>

                        <div class="form-group">
                            <label for="contentArea" class="col-form-label">Компонент</label>
                            <textarea name="template" id="contentArea" rows="10" class="form-control">{{ $widget->template }}</textarea>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.widgets.index') }}" class="btn btn-default">Назад</a>
                            <button class="btn btn-success pull-right">Изменить</button>
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