<nav class="topbar">
    <div class="container">
        <div class="row m-0">
            <p class="m-0">Contact Us (844) 305-7674</p>
        </div>
    </div>
</nav>

<nav class="navbar main-nav navbar-expand-md ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img style="position:relative; top: -2px;" class="h-100" src="https://www.ni-q.com/wp-content/uploads/2019/04/niq-logo-sm.png"/>
        </a>
        <button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @foreach($site_menu->items()->get() as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $item->path }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
           
        </div>
    </div>
</nav>