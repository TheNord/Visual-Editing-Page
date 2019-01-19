<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a></li>
    @can ('manage-pages')
        <li class="nav-item"><a class="nav-link{{ $page === 'pages' ? ' active' : '' }}" href="{{ route('admin.pages.index') }}">Pages</a></li>
    @endcan
    @can ('manage-pages')
        <li class="nav-item"><a class="nav-link{{ $page === 'menu' ? ' active' : '' }}" href="{{ route('admin.menu.index') }}">Menu</a></li>
    @endcan
    @can ('manage-settings')
        <li class="nav-item"><a class="nav-link{{ $page === 'settings' ? ' active' : '' }}" href="{{ route('admin.settings.index') }}">Settings</a></li>
    @endcan
</ul>