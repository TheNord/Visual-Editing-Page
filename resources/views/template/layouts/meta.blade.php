@section('title'){{ $data->title }}@endsection

@section('meta')
@if ($data->hasDescription())
<meta name="description" content="{{ $data->description }}">
@endif
@if ($data->hasKeywords())
<meta name="keywords" content="{{ $data->keywords }}">
@endif
@endsection