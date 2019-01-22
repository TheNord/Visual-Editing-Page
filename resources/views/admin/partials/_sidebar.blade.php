<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="{{ route('admin.home') }}">
            <i class="fa fa-dashboard"></i> <span>Админ-панель</span>
        </a>
    </li>
    <li><a href="{{ route('admin.pages.index') }}"><i class="fa fa-sticky-note-o"></i> <span>Страницы</span></a></li>
    <li><a href="{{ route('admin.menu.index') }}"><i class="fa fa-list-ul"></i> <span>Меню</span></a></li>
    <li><a href="{{ route('admin.widgets.index') }}"><i class="fa fa-th"></i> <span>Виджеты</span></a></li>
    <li><a href="{{ route('admin.template-manager.index') }}"><i class="fa fa-files-o"></i> <span>Менеджер шаблонов</span></a></li>
    <li><a href="{{ route('admin.settings.index') }}"><i class="fa fa-cogs"></i> <span>Настройки сайта</span></a></li>

</ul>