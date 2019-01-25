<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
        <a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> 
        <span>Админ-панель</span></a>
    </li>
    <li class="treeview menu-open">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i> <span>Записи</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-circle-o"></i> Все записи</a></li>
            <li><a href="{{ route('admin.posts.categories.index') }}"><i class="fa fa-circle-o"></i> Категории</a></li>
            <li><a href="{{ route('admin.posts.tags.index') }}"><i class="fa fa-circle-o"></i> Метки</a></li>
        </ul>
    </li>
    <li><a href="{{ route('admin.pages.index') }}"><i class="fa fa-sticky-note-o"></i> <span>Страницы</span></a></li>
    <li><a href="{{ route('admin.menu.index') }}"><i class="fa fa-list-ul"></i> <span>Меню</span></a></li>
    <li><a href="{{ route('admin.widgets.index') }}"><i class="fa fa-th"></i> <span>Виджеты</span></a></li>
    <li><a href="{{ route('admin.template-manager.index') }}"><i class="fa fa-files-o"></i> <span>Менеджер шаблонов</span></a></li>
    <li><a href="{{ route('admin.settings.index') }}"><i class="fa fa-cogs"></i> <span>Настройки сайта</span></a></li>

</ul>