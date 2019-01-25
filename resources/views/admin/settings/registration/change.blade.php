@extends('admin.layout')

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
                    <h3 class="box-title">Выбор статуса регистрации</h3>
                    @include('admin.partials.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        {{ Form::open([
                        'route' =>  ['admin.settings.updateRegistration'],
                        'method' => 'put']
                        ) }}
                        <div class="form-group">
                            <label for="status" class="col-form-label">Статус</label>
                            <select id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                                    <option value="1" {{ $current == 1 ? ' selected' : '' }}>
                                        Регистрация доступна
                                    </option>
                                    <option value="0" {{ $current == 0 ? ' selected' : '' }}>
                                        Регистрация запрещена
                                    </option>
                            </select>
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