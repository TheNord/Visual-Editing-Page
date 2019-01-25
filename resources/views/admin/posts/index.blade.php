@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление записями
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
                <div class="box-header">
                    <h3 class="box-title">Список записей</h3>
                    @include('admin.partials.errors')
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="main-content" class="table table-bordered table-striped offsort">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Категория</th>
                            <th>Метки</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                        @foreach($post->tags as $tag)
                                        {{ $tag->name }}
                                        @endforeach
                               </td>
                               <td>{{ $post->updated_at }}</td>
                                <td><a href="{{ route('admin.posts.edit', $post->slug) }}" class="fa fa-pencil fl"></a>
                                    {{ Form::open(['route' => ['admin.posts.destroy', $post->slug],
                                    'method'=>'delete']) }}
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