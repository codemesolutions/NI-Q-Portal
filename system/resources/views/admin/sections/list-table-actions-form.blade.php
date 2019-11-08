<a class="btn btn-primary btn-sm ml-auto" href="{{$submissions_route}}?id={{$user->id}}"><i class="fas fa-inbox"></i></a>
<a class="btn btn-primary btn-sm ml-auto" href="{{$questions_route}}?id={{$user->id}}"><i class="fas fa-question"></i></a>
<a class="btn btn-primary btn-sm ml-auto" href="{{$view_route}}{{$user->name}}"><i class="fas fa-eye"></i></a>
<a class="btn btn-warning text-white btn-sm" href="{{$update_route}}?id={{$user->id}}"><i class="fas fa-pen"></i></a>
<a class="btn btn-danger btn-sm" href="{{$delete_route}}?id={{$user->id}}"><i class="fas fa-trash"></i></a>