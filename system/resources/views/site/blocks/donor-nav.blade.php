<div class="navbar navbar-expand-md donor-nav bg-dark  p-0 py-3 ">
    
        <div class="container  py-1">
            <button class="btn btn-clean navbar-toggler" data-toggle="collapse" data-target="#navbarTogglerDemo01" ><i class="fas fa-bars"></i> MENU</button>
            
          
                <ul class="navbar-nav d-none d-md-flex mr-auto">
                   
                   @foreach($donor_menu->items()->get() as $item)
                        @foreach($userPermissions as $permmission)
                            @if(!is_null($item->permissions()->where('name', $permmission->name)->first()))
                                <li class="nav-item"><a class="nav-link" href="{{url($item->path)}}">{{$item->name}}</a></li>
                                @php break; @endphp
                            @endif
                        @endforeach
                    @endforeach
                    
                </ul>
                @if(!is_null(Auth::user()->donors()->first()) && Auth::user()->donors()->first()->milkkits()->count() > 0)
                
                    <a href="{{Route('milkkit_send')}}" class="btn btn-teal-sm mt-1">Request Milk Kit</a>
               

                
                    <a href="{{Route('milkkit_send')}}" class="btn btn-teal-sm-outline mt-1">Schedule A Pickup</a>
               

                @endif
           
                 <a class="btn btn-teal-sm mt-1  ml-3 mr-2 mr-md-0" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }} 
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
        </div>
    </div>
</div>
 <div style="margin-top: -1.5rem; border-top: #111 1px solid; " class="collapse navbar-collapse bg-dark donor-nav-dropdown mb-4" id="navbarTogglerDemo01">
   
        <ul class="nav flex-column p-0 text-white">
           
            @foreach($donor_menu->items()->get() as $item)
                @foreach($userPermissions as $permmission)
                    @if(!is_null($item->permissions()->where('name', $permmission->name)->first()))
                     <li class="nav-item p-0">
                        <div class="container">
                            <a class="nav-link" href="{{Route('home')}}"> Home</a>
                        </div>
                    </li>
                    @endif
                @endforeach
            @endforeach
        </ul>
    
</div>