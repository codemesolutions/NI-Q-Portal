@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        
        <div class="container-fluid  p-3 p-md-5">
            <form class="px-5" method="POST" action="{{$form_action_route}}" enctype="multipart/form-data">
                <div class="p-3 p-md-5 border bg-white">
                    <h5 class="mb-4">System Settings</h5>
                 
                   
                    @if(isset($settings))
                        @php $count = 1; @endphp
                        @foreach($settings as $setting)
                            <div class="border bg-light p-4 mb-4">
                           
                              
                            <table style="table-layout:fixed;" class="w-100 ">
                                <tbody>
                                    <tr>
                                        <td>
                                            {{$setting->name}}
                                        </td>
                                        <td>
                                            @if($setting->type == "text")
                                            <input class="form-control" type="text" name="{{$setting->name}}" value="{{$setting->value}}"/>
                                            @elseif($setting->type == "textarea")
                                                <textarea class="form-control" name="{{$setting->name}}">{{$setting->value}}</textarea>
                                            @endif
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                                
                            </div>
                           
                        @endforeach
                    @endif
                   
                
                </div>
               
                @csrf
                <div class="row m-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
