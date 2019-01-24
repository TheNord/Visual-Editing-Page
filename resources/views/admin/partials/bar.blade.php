<div id="adminbar">
    <div class="left-a-panel">

        <ul>
            <li>
                <a href="{{route('admin.home')}}"><i class="fas fa-home"></i></a>
            </li>
            @if (isset($page))
                <li>
                    <a href="{{route('admin.pages.edit', $page)}}"><i class="fas fa-pencil-alt ab-icon"></i>Редактирование страницы</a>
                </li>
            @endif
        </ul>

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="account-panel">
        @csrf
        <a href="#" class="screen-reader-shortcut" onclick="document.getElementById('logout-form').submit()">Выйти</a>
    </form>
</div>