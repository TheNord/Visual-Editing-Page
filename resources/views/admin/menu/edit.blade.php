@extends('layouts.app')
@section('content')
    @include('admin.menu._nav')
    <form method="POST" action="{{ route('admin.menu.update', $menu) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title" class="col-form-label">Title</label>
            <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
                   value="{{ old('title', $menu->title) }}" required>
            @if ($errors->has('title'))
                <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <label for="page" class="col-form-label">Page</label>
            <select id="page" class="form-control{{ $errors->has('page_id') ? ' is-invalid' : '' }}" name="page_id">
                @foreach ($pages as $page)
                    <option value="{{ $page->id }}"{{ $page->id == old('parent', $menu->page_id) ? ' selected' : '' }}>
                        @for ($i = 0; $i < $page->depth; $i++) &mdash; @endfor
                        {{ $page->title }}
                    </option>
                @endforeach;
            </select>
            @if ($errors->has('page_id'))
                <span class="invalid-feedback"><strong>{{ $errors->first('page_id') }}</strong></span>
            @endif
        </div>


        <div class="form-group">
            <label for="parent" class="col-form-label">Parent</label>
            <select id="parent" class="form-control{{ $errors->has('parent') ? ' is-invalid' : '' }}" name="parent">
                <option value=""></option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}"{{ $parent->id == old('parent', $menu->parent_id) ? ' selected' : '' }}>
                        @for ($i = 0; $i < $parent->depth; $i++) &mdash; @endfor
                        {{ $parent->title }}
                    </option>
                @endforeach;
            </select>
            @if ($errors->has('parent'))
                <span class="invalid-feedback"><strong>{{ $errors->first('parent') }}</strong></span>
            @endif
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection