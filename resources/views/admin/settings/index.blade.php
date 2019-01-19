@extends('layouts.app')
@section('content')
    @include('admin.settings._nav')
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Property name</th>
            <th>Value</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Home page</td>
            <td>{{$settings->getHome()->title}}</td>
            <td>
                <a href="{{route('admin.settings.homePage')}}" class="btn btn-outline-primary">
                    <i class="fas fa-pencil-alt"></i> Change
                </a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection