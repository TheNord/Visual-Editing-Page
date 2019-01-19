@extends('layouts.app')
@section('content')
    @include('admin.settings._nav')
    <div class="card">
        <h5 class="card-header">Change home page settings</h5>
        <div class="card-body">
            <h5 class="card-title">Select the page:</h5>
            <form method="POST" action="{{ route('admin.settings.updateHomePage') }}">
                @csrf
                @method('PUT')

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

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection