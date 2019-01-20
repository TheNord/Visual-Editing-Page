@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Редактирование страницы
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Изменение страницы</h3>
                    @include('admin.partials.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        {{ Form::open([
                        'route' =>  ['admin.pages.update', $page->id],
                        'method' => 'put']
                        ) }}
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder=""
                                   value="{{ $page->title }}">
                        </div>

                        <div class="form-group">
                            <label for="slug">Слаг</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder=""
                                   value="{{ $page->slug }}">
                        </div>


                        <div class="form-group">
                            <label for="parent" class="col-form-label">Parent</label>
                            <select id="parent" class="form-control"
                                    name="parent">
                                <option value=""></option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent', $page->parent_id) ? ' selected' : '' }}>
                                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                                        {{ $parent->title }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      data-image-url="{{ route('admin.ajax.upload.image') }}"
                                      class="form-control summernote">{{ $page->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание (мета)</label>
                            <textarea name="description" id="" rows="3"
                                      class="form-control">{{ $page->description }}</textarea>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-default">Назад</a>
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