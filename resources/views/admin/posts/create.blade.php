@extends('admin.layout', ['page' => 'posts'])

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Управление записями
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            {{ Form::open(['route' => 'admin.posts.store', 'files' => true]) }}
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Создание новой записи</h3>
                        @include('admin.partials.errors')
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Название</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="contentArea" class="col-form-label">Полный текст</label>
                            <textarea name="content" id="contentArea" rows="10"
                                      class="form-control summernote"
                                      data-image-url="{{ route('admin.ajax.upload.image') }}"
                            >{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Мета информация</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="description" class="col-form-label">Описание</label>
                            <textarea id="description" class="form-control" name="description"
                                      rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="col-form-label">Ключевые слова</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder=""
                                   value="{{ old('keywords') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Статус</label>
                            <select id="status" class="form-control" name="status">
                                @foreach ($statuses as $status => $label)
                                    <option value="{{ $status }}"{{ $status == old('status') ? ' selected' : '' }}>{{ $label }}</option>
                                @endforeach;
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-form-label">Категория</label>
                            <select id="category" class="form-control" name="category">
                                <option value=""></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"{{ $category->id == old('category') ? ' selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="form-group">
                        <label>Метки</label>
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Выберите метки" style="width: 100%;" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"{{ $category->id == old('tag') ? ' selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>

                    </div>  

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Опубликовать</button>
                    </div>
                </div> 

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Миниатюра записи</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">     
                            <label for="miniature" class="col-form-label">Задать миниатюру</label>
                            <input type="file" id="miniature" name="miniature">
                        </div>
                    </div>  
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

@include('admin.partials.summernote')