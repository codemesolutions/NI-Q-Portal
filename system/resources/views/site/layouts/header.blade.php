<nav class="topbar bg-teal ">
    <div class="container">

    </div>
</nav>

<nav class="navbar main-nav navbar-expand-md p-3 p-md-0 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center  mx-auto mx-0 justify-content-center justify-content-md-start" href="{{ url('/') }}">
            <img style="position:relative; top: -4px;" class="w-50" src="https://www.ni-q.com/wp-content/uploads/2019/04/niq-logo-sm.png"/> <p class="m-0 mt-1 text-dark front-weight-light small"> Portal</p>
        </a>


        <div class=" d-flex p-0 w-100 justify-content-center justify-content-md-end">

            @if(isset($donor_menu))
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto d-none">
                    @foreach($donor_menu->items()->orderBy('created_at')->get() as $item)
                        @foreach($userPermissions as $permmission)
                            @if(!is_null($item->permissions()->where('name', $permmission->name)->first()))
                                <li class="nav-item"><a class="nav-link" href="{{url($item->path)}}">{{$item->name}}</a></li>
                                @php break; @endphp
                            @endif
                        @endforeach
                    @endforeach

                </ul>
                <a href="/" class="btn btn-light  btn-sm "> <i class="fas fa-home text-dark"></i></a>
            @elseif(isset($site_menu))
                <a class="" href="https://ni-q.com">Back to ni-q.com</a>
                @if (Route::has('register'))

                        <a class=" ml-auto" href="{{ route('register') }}">{{ __('Become A Donor!') }}</a>

                @endif

            @endif

            @if(isset($messages))
                <div class="dropdown ml-2 ">
                    <button class="btn  btn-light btn-sm  text-uppercase dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-book text-teal mr-1 d-md-none "></i> <span class="small font-weight-bold d-none d-md-inline ">Guidelines<span>
                    </button>
                    <div style="border-top: #12bdd0 3px solid;width: 250px; " class="dropdown-menu dropdown-menu-left p-3 rounded-0" aria-labelledby="dropdownMenuButton">
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold border-bottom py-2" href="/Guidelines"><i class="fas fa-angle-right text-teal mr-1"></i> Collecting HDM & Storage</a>
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold border-bottom py-2" href="/Remember"><i class="fas fa-angle-right text-teal mr-1"></i> Things to remember as a Donor</a>
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold border-bottom py-2" href="/Milkkit"><i class="fas fa-angle-right text-teal mr-1"></i> Milk Kit Packing Instructions</a>
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold  py-2" href="/Volumes"><i class="fas fa-angle-right text-teal mr-1"></i> Various volumes in a Milk Kit</a>
                    </div>
                </div>

            @endif

            @if(isset($messages))
                <div class="dropdown ml-2">
                    <button class="btn  btn-light btn-sm  text-uppercase btn-clear dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-comment text-teal mr-1 d-md-none"></i> <span class="small font-weight-bold d-none d-md-inline">Messages</span>({{$messages->count()}})
                    </button>
                    <div style="width: 250px; border-top: #12bdd0 3px solid;" class="p-3 dropdown-menu dropdown-menu-right shadow rounded-0" aria-labelledby="dropdownMenuButton">
                        <div class="d-flex w-100 bg-white border-bottom align-items-center">
                            <p class="m-0 pl-3 py-2 font-weight-bold text-uppercase" style="font-size: 11px;">Messages({{$messages->count()}})</p>
                            <button class="btn btn-sm small ml-auto p-0 mr-3" data-toggle="modal" data-target="#messageModal"><span class=" font-weight-bold"> <i class="fas fa-pen text-teal "></i> Write</span></button>
                        </div>
                        @foreach($messages as $convo)
                            <a class="dropdown-item small border-bottom text-wrap d-flex align-items-center py-2" href="{{url('/messages/message')}}?id={{$convo->id}}">
                                @php
                                     $comments = $convo->comments()->orderBy('created_at', 'desc')->first();
                                @endphp

                                @if(!is_null($comments) && $convo->is_new && $comments->from_user_id === 5568)
                                    <i class="fas fa-comment text-teal mr-2"></i>
                                @else
                                    <i class="fas fa-comment text-muted mr-2"></i>
                                @endif
                                <p style="font-size: 11px;" class="font-weight-bold text-break">
                                     {{\Illuminate\Support\Str::limit($convo->subject, 15, $end='...') }}
                                </p>
                                <span class="text-muted ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>

                            </a>
                        @endforeach
                        <div class="bg-white w-100 text-center py-2 ">
                            <a href="/messages" class="small text-dark font-weight-bold">VIEW ALL</a>
                        </div>
                    </div>
                </div>

            @endif

            @if(!is_null(Auth::user()))

                <div class="dropdown ml-2">
                    <button class="btn  btn-light btn-sm text-uppercase   dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user text-teal mr-1 d-md-none"></i> <span class="small font-weight-bold d-none d-md-inline">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                    </button>
                    <div style="border-top: #12bdd0 3px solid;" class="mt-1 dropdown-menu rounded-0 shadow dropdown-menu-right p-3" aria-labelledby="dropdownMenuButton">
                        @if(!is_null(Auth::user()->donors()->first()))
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold border-bottom pl-3 py-2" href="/account"><i class="fas fa-angle-right text-teal mr-1"></i> Account</a>
                        @endif
                        <a style="font-size: 12px;" class="dropdown-item font-weight-bold pl-3 py-2" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-angle-right text-teal mr-1"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>

            @endif


        </div>

    </div>
</nav>
