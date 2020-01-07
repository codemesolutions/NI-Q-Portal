

<nav class="navbar navbar-expand-md w-100 bg-gradient" style="height: 37px;">

        <a class="navbar-brand " href="{{ url('/') }}">
            <img style="margin-top: -10px;" class="p-0 pl-3" src="/img/niq-logo-sm.png"/>
        </a>
         @if(!isset($sidebarHide) || !$sidebarHide)
            <a class="btn btn-primary text-white mr-1 sidebar-toggle btn-sm small"><i class="fas fa-outdent"></i> Menu </a>
         @endif
         <a class=" mr-4 btn btn-dark btn-sm small" href="/">Back To Portal </a>
        <div class="ml-5">


        </div>

        <a class="btn btn-danger ml-auto btn-sm small" href="/system/sync"><i class="fas fa-sync"></i> Sync</a>

        <a id="navbarDropdown" class="btn btn-primary ml-2 px-3 text-white dropdown-toggle btn-sm small" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>



</nav>


