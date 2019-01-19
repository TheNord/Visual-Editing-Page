<div id="adminbar">
    <div class="left-a-panel">

        <ul>
            <li>
                <a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a>
            </li>
            @if ($page)
                <li>
                    <a href="{{route('admin.pages.edit', $page)}}"><i class="fas fa-pencil-alt ab-icon"></i>Edit page</a>
                </li>
                <li>
                    @if (Session::get('interactive-editing'))
                        <a href="{{route('admin.stop.editing')}}"><i class="fas fa-sync-alt ab-icon"></i></i>Stop interactive editing</a>
                    @else
                        <a href="{{route('admin.start.editing')}}"><i class="fas fa-sync-alt ab-icon"></i></i>Start interactive editing</a>
                    @endif
                </li>
            @endif
        </ul>

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="account-panel">
        @csrf
        <a href="#" class="screen-reader-shortcut" onclick="document.getElementById('logout-form').submit()">Выйти</a>
    </form>
</div>