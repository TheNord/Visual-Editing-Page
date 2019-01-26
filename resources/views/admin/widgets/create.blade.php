@extends('admin.layout', ['page' => 'widgets'])

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
                    <h3 class="box-title">Добавление нового виджета</h3>
                    @include('admin.partials.errors')
                </div>
                {!! Form::open(['route' => 'admin.widgets.store']) !!}
                <div class="box-body">
                    <div class="col-md-12">

                        <div class="box box-solid collapsed-box">
                            <div class="box-header with-border">
                                <i class="fa fa-text-width"></i>
                                <h3 class="box-title">Написание шаблона виджетов</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <dl>
                                    <dd>В написании шаблона для виджета вы можете использовать любые html тэги.</dd>
                                    <dd>А также php код и вставку скриптов, но будьте осторожны и предварительно проверьте ваш код, это может испортить сайт.</dd>
                                    <dd>Для проверки PHP кода вы можете использовать сервис: <a href="https://code.phpsandbox.org/" target="_blank">PHPSandbox</a> либо любую другую песочницу PHP.</dd>
                                    <dd>Для проверки HTML+JS кода вы можете использовать сервис: <a href="https://jsfiddle.net/">JSfiddle</a>.</dd>
                                    <br>
                                    <dt>Шаблонизатор Blade</dt>
                                    <dd>Также для удобства написания виджета, вы можете использовать шаблонизатор Blade, он позволяет писать облегченный PHP код.</dd>
                                    <dd>Подробную документацию о шаблонизаторе вы можете прочитать на <a href="http://laravel.su/docs/5.4/blade">русском языке</a>.</dd>
                                    <dd>Либо в официальной документации на <a href="https://laravel.com/docs/5.7/blade">английском языке</a>.</dd>
                                </dl>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="contentArea" class="col-form-label">Шаблон</label>
                            <textarea name="template" id="contentArea" rows="10"
                                      class="form-control">{{ old('template') }}</textarea>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.widgets.index') }}" class="btn btn-default">Назад</a>
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