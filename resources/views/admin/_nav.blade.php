<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a></li>
    @can ('manage-pages')
        <li class="nav-item"><a class="nav-link{{ $page === 'pages' ? ' active' : '' }}" href="{{ route('admin.pages.index') }}">Pages</a></li>
    @endcan
</ul>