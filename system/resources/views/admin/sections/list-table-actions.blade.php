@if(preg_match("/\?/", $view_route) || strpos($view_route, "?") !== false)
<a class="btn btn-primary btn-sm ml-auto" href="{{$view_route}}&id={{$user->id}}"><i class="far fa-eye"></i></a>
<a class="btn btn-warning text-white btn-sm" href="{{$update_route}}&id={{$user->id}}"><i class="fas fa-pen"></i></a>
@else
<a class="btn btn-primary btn-sm ml-auto" href="{{$view_route}}?id={{$user->id}}"><i class="far fa-eye"></i></a>
<a class="btn btn-warning text-white btn-sm" href="{{$update_route}}?id={{$user->id}}"><i class="fas fa-pen"></i></a>
@endif


<a class="btn btn-danger btn-sm" href="{{$delete_route}}"><i class="fas fa-trash"></i></a>