@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление метками
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                @include('admin.partials.errors')
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Добавление метки</h3>
                        </div>
                        <div class="box-body">
                        {!! Form::open(['route' => 'admin.posts.tags.store']) !!}
                            <div class="form-group">
                                <label for="name">Название</label>
                                <input name="name" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="slug">Слаг (Url)</label>
                                <input name="slug" type="text" class="form-control">
                            </div>
                        </div>  

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                        {!! Form::close() !!}
                    </div> 
                </div>

                <div class="col-md-8">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="main-table" class="table table-bordered table-striped offsort">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Слаг (Url)</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>
                                            {{ $tag->name }}
                                        </td>
                                        <td>
                                            {{ $tag->slug }}
                                        </td>
                                        <td><a href="{{ route('admin.posts.tags.edit', $tag->slug) }}" class="fa fa-pencil fl"></a>
                                            {{ Form::open(['route' => ['admin.posts.tags.destroy', $tag->slug], 'method'=>'delete']) }}
                                            <button onclick="return confirm('Are you sure want delete it?')" type="submit" class="delete">
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
                </div>
            </div>    
        </section>
        <!-- /.content -->
    </div>
@endsection