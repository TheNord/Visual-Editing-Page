@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить страницу
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Создание новой страницы</h3>
                    @include('admin.partials.errors')
                </div>
                <div class="box-body">
                    {{ Form::open(['route' => 'admin.pages.store']) }}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Заголовок</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder=""
                                   value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputSlug">Слаг (URL)</label>
                            <input type="text" class="form-control" id="exampleInputSlug" name="slug" placeholder=""
                                   value="{{ old('slug') }}">
                        </div>

                        <div class="form-group">
                            <label>Родительская страница</label>
                            <select id="parent" class="form-control"
                                    name="parent">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent') ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->title }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contentArea" class="col-form-label">Полный текст</label>
                            <textarea name="content" id="contentArea" rows="10"
                                      class="form-control summernote"
                                      data-image-url="{{ route('admin.ajax.upload.image') }}"
                            >{{ old('content') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Описание (мета)</label>
                            <textarea id="description" class="form-control" name="description"
                                      rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-form-label">Ключевые слова (через запятую)</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder=""
                                   value="{{ old('keywords') }}">
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a class="btn btn-default" href="{{ route('admin.pages.index') }}">Назад</a>
                            <button class="btn btn-success pull-right">Добавить</button>
                        </div>
                    </div>
                {{ Form::close() }}
                <!-- /.box-footer-->
                </div>
                <!-- /.box -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection