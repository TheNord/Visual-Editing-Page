@extends('admin.layout', ['page' => 'components'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление виджетами
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
                        <a href="{{ route('admin.widgets.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="main-table" class="table table-bordered table-striped offsort">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Шорткод</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($widgets as $widget)
                            <tr>
                                <td>
                                    {{ $widget->name }}
                                </td>
                                <td>
                                    <b>[TPart={{ $widget->id }}]</b>
                                </td>
                                <td><a href="{{ route('admin.widgets.edit', $widget->id) }}" class="fa fa-pencil fl"></a>
                                    {{ Form::open(['route' => ['admin.widgets.destroy', $widget->id], 'method'=>'delete']) }}
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