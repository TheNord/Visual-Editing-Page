<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach ($topMenuPages as $menu)
                    
                    @if ($menu->hasChildren())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- Если меню относится к странице --}}
                                @if($menu->type == 0)
                                {{ $menu->title }}<span class="caret"></span>
                                @else
                                {{-- Если меню относится к категории --}}
                                {{ $menu->name }}<span class="caret"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($moreMenu = $menu->children()->get() as $menu)
                                    @if($menu->type == 0)
                                    <a class="dropdown-item"
                                       href="{{ route('page', page_path($menu->page)) }}">{{ $menu->title }}</a>
                                    @else
                                    <a class="dropdown-item"
                                       href="{{ route('category.index', $menu->category) }}">{{ $menu->title }}</a>
                                    @endif   
                                @endforeach
                            </div>
                        </li>
                    @endif

                    @if ($menu->isRoot())
                        @if($menu->type == 0)
                        <li><a class="nav-link" href="{{ route('page', page_path($menu->page)) }}">{{ $menu->title }}</a></li>
                        @else
                        <li><a class="nav-link" href="{{ route('category.index', $menu->category) }}">{{ $menu->title }}</a></li>
                        @endif
                    @endif

                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
