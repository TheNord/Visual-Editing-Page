@extends('admin.layout', ['page' => 'settings'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление настройками
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
                    <table id="main-table" class="table table-bordered table-striped offsort">
                        <thead>
                        <tr>
                            <th>Наименование</th>
                            <th>Значение</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Домашняя страница</td>
                                <td>{{$settings->getHome()->title}}</td>
                                <td><a href="{{ route('admin.settings.homePage') }}" class="fa fa-pencil fl"></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Регистрация</td>
                                <td>{{$settings->getRegistrationStatus() ? 'Регистрация доступна' : 'Регистрация запрещена'}}</td>
                                <td><a href="{{ route('admin.settings.registration') }}" class="fa fa-pencil fl"></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Email для обратной связи</td>
                                <td>{{$settings->getEmail()}}</td>
                                <td><a href="{{ route('admin.settings.contact') }}" class="fa fa-pencil fl"></a>
                                </td>
                            </tr>
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