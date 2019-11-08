@extends('admin.layouts.app')

@section('content')
<div class="bg-light h-100">
    <div class="bg-dark px-3 py-3">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div class="row m-0 p-1 h-100 overflow-auto">
        <div class="col-12 mb-5 p-0">
            
            <div class="row m-0 pb-5">
                <div class="col-6 p-1">
                    <div class=" bg-white text-dark border  p-5 row m-0 align-items-center justify-content-start">
                        <h6 class="text-uppercase m-0"> <i class="fas fa-bell bg-info p-2 text-white "></i> Notifications</h6>
                        <div class="w-100 mt-4 ">

                            <ul class="list-group ">
                                @foreach($request->user()->notifications()->orderBy('created_at', 'desc')->get() as $convo)
                                <a 
                                    class="list-group-item rounded-0 bg-info text-white" 
                                    href="{{$convo->resource}}">
                                    <span class="bg-white d-inline-block text-center text-info mr-2 text-uppercase" style="height: 20px; width: 20px; ">
                                        {{$convo->notification_type_id[0]}}
                                    </span>
                                        {{$convo->message}}
                                    </a>
                                @endforeach
                        
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6 p-1">
                    <div class=" bg-white text-dark border  p-5 row m-0 align-items-center justify-content-start">
                        <h6 class="text-uppercase m-0"> <i class="fas fa-inbox bg-primary p-2 text-white "></i> Messages</h6>
                        <div class="w-100 mt-4 ">

                            <ul class="list-group ">
                                @foreach($request->user()->conversations()->orderBy('created_at', 'desc')->get() as $convo)
                                <a class="list-group-item rounded-0 bg-primary text-white" href="{{Route('admin.message')}}"><span class="bg-white d-inline-block text-center text-primary mr-2 text-uppercase" style="height: 20px; width: 20px; ">{{$convo->subject[0]}}</span>{{$convo->subject . ' - ' .$convo->users()->where('users.id', '!=', $request->user()->id)->first()->name}}</a>
                                @endforeach
                        
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\Donor::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Approved Donors</p>
                    </div>
                </div>
                 <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Donor Application Submissions</p>
                    </div>
                </div>
                <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->where('blocked', true)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Donor Application Disqualified</p>
                    </div>
                </div>
                 <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\FormSubmission::where('form_id', 1)->where('completed', true)->count()}}</h3>
                        <p class="m-0 small font-weight-bold">Donor Application Completed</p>
                    </div>
                </div>
                <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\MilkKit::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Milkkits</p>
                    </div>
                </div>
                 <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\BloodKit::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Bloodkit</p>
                    </div>
                </div>
               <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\User::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Total Users</p>
                    </div>
                </div>
                 <div class="col-3 p-1">
                    <div class="bg-white border  p-5 text-center">
                        
                        <h3 class="m-0">{{\App\Page::count()}}</h3>
                        <p class="m-0 small font-weight-bold">Total Pages</p>
                    </div>
                </div>
                
            </div>
        </div>
        
        
    </div>
</div>
    
@endsection
