<div id="adminbar">
    <div class="left-a-panel">

        <ul>
            <li>
                <a href="{{route('admin.home')}}"><i class="fas fa-home ab-icon"></i>Администрационная панель</a>
            </li>
            @if (isset($page))
                <li>
                    <a href="{{route('admin.pages.edit', $page)}}"><i class="fas fa-pencil-alt ab-icon ab-icon"></i>Редактирование страницы</a>
                </li>
            @endif
            @if (isset($category))
                <li>
                    <a href="{{route('admin.posts.categories.edit', $category)}}"><i class="fas fa-pencil-alt ab-icon ab-icon"></i>Редактирование категории</a>
                </li>
            @endif
            @if (isset($post))
                <li>
                    <a href="{{route('admin.posts.edit', $post)}}"><i class="fa fa-edit ab-icon"></i>Редактирование записи</a>
                </li>
            @endif
        </ul>

    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="account-panel">
        @csrf
        <a href="#" class="screen-reader-shortcut" onclick="document.getElementById('logout-form').submit()">Выйти</a>
    </form>
</div>