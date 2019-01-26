@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Управление пользователями
            </h1>
        </section>

        <section class="content">
            {{ Form::open(['route' => 'admin.users.store']) }}
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание нового пользователя</h3>
                        @include('admin.partials.errors')
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Имя</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="title">Пароль</label>
                            <input type="text" class="form-control" name="password" value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{ route('admin.users.index') }}">Назад</a>
                        <button class="btn btn-success pull-right">Добавить</button>
                    </div>
                </div>
            {{ Form::close() }}
            </div>
        </section>
    </div>
@endsection

@include('admin.partials.summernote')