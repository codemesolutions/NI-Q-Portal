<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NI-Q Donor Portal</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
 


    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
 
   
 @include('admin.layouts.header')
  
   <div class="row m-0" style="height: calc(100% - 77px);" >
    @if(!isset($sidebarHide) || !$sidebarHide)
        <div class="h-100 overflow-auto sidebar" >
           
            <ul class="nav flex-column">
               @foreach($admin_menu->items()->orderBy('created_at', 'asc')->get() as $item)
                  @foreach($userPermissions as $permmission)
                     @if(!is_null($item->permissions()->where('name', $permmission->name)->first()))
                        <li class="nav-item">
                           <a id="navbarDropdown" class="nav-link" href="{{url($item->path)}}" role="link"  aria-haspopup="true" aria-expanded="false" v-pre>
                              <i class="fas fa-heartbeat pt-1"></i> <span>{{$item->name}}</span>
                           </a>
                        </li>
                        @php break; @endphp
                     @endif
                  @endforeach
               @endforeach
                
                
            </ul>
        </div>
        @endif
        <div class="col p-0 h-100 overflow-hidden contents">
            
             @yield('content')
        </div>
   </div>
   
   
  
    @include('admin.layouts.footer')
    
  
    

