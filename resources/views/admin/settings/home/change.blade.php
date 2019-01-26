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
                    <h3 class="box-title">Выбор главной страницы</h3>
                    @include('admin.partials.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        {{ Form::open([
                        'route' =>  ['admin.settings.updateHomePage'],
                        'method' => 'put']
                        ) }}
                        <div class="form-group">
                            <label for="page" class="col-form-label">Page</label>
                            <select id="page" class="form-control{{ $errors->has('page') ? ' is-invalid' : '' }}" name="page">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->id }}"{{ $page->id == old('page', $current->value) ? ' selected' : '' }}>
                                        {{ $page->title }}
                                    </option>
                                @endforeach;
                            </select>
                            @if ($errors->has('page'))
                                <span class="invalid-feedback"><strong>{{ $errors->first('page') }}</strong></span>
                            @endif
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