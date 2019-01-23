@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление страницами
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
                    <div class="col-md-12">
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
                            <label for="slug">Слаг (URL)</label>
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
                            <textarea name="content" id="content" cols="30" rows="10"
                                      data-image-url="{{ route('admin.ajax.upload.image') }}"
                                      class="form-control summernote">{{ $page->content }}</textarea>
                        </div>

                        <h3 class="meta-block">Мета информация</h3>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="description" rows="3"
                                      class="form-control">{{ $page->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-form-label">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder=""
                                   value="{{ $page->keywords }}">
                        </div>

                        <h3 class="meta-block">Дополнительные опции</h3>

                        <div class="form-group">
                            <label for="template" class="col-form-label">Шаблон страницы</label>
                            <select id="template" class="form-control"
                                    name="template">
                                <option value="">Стандартный шаблон</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->get('path') }}" {{ $template->get('path') == old('template', $page->template) ? ' selected' : '' }}>
                                        {{ $template->get('name') }}
                                    </option>
                                @endforeach;
                            </select>
                        </div>

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

@include('admin.partials.summernote')