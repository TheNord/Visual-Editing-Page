@extends('admin.layout', ['page' => 'settings'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление настройками
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Email для обратной связи</h3>
                    @include('admin.partials.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        {{ Form::open([
                        'route' =>  ['admin.settings.updateContact'],
                        'method' => 'put']
                        ) }}
                        <div class="form-group">
                            <label for="email">Название</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $current }}">
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-default">Назад</a>
                            <button class="btn btn-warning pull-right">Изменить</button>
                        </div>
                    </div>
                    <!-- /.box-footer-->
                </div>
            {{ Form::close() }}
            <!-- /.box -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection