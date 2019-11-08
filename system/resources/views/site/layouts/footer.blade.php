
    <footer class="">
        <div class="footer-top py-4 bg-dark">
            <div class="container">
                 <ul class="nav text-uppercase">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Become a donor!') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
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
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
         <div class="footer-bottom py-5 bg-light">
            <div class="container">
                <p>Copyright ©2019 Ni-Q, LLC. All rights reserved. <strong>HDM Plus™</strong> is a registered trademark of Ni-Q, LLC. <a class="ml-1" href="https://www.ni-q.com/privacy-policy/" hidefocus="true" style="outline: none;">Privacy Policy </a></p>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
 
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/site.js') }}" defer></script>

</body>
</html>