@extends('site.layouts.app')

@section('content')


<div class=" jumbotron jumbotron-fluid bg-light border-top border-bottom py-0 ">
    <div class="container py-0 text-left">
        <div class="py-3 d-block d-md-flex m-0 w-100 align-items-center justify-content-center">
            <p class="font-weight-bold m-0 mr-md-auto mb-4 mb-md-0 d-none">Welcome, <span class=" font-weight-bold text-teal">{{Auth::user()->name}}</span></p>
            @if(!is_null(Auth::user()->donors()->first()))
            <p>Donor ID: <span class="text-muted">{{Auth::user()->donors()->first()->donor_number}}</span> </p>
            @endif
            @if(!is_null(Auth::user()->donors()->first()) && !is_null(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()) && !is_null(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->recieve_date))
                <p class="ml-md-3">Lab Results Status: {!!Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->status === 1 ? "<span class='text-success'>Passed</span>": "<span class='text-danger'>Failed</span>"!!} </p>
                <p class="ml-md-3">Lab Results Recieved Date: <span class="text-muted">{{date('m/d/Y', strtotime(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()->recieve_date)) }} </span> </p>
            @endif
            <div class="col-12 col-md-auto ml-0 ml-md-auto p-0 mt-2 mt-md-0">
                @if(!is_null(Auth::user()->donors()->first()) && Auth::user()->donors()->first()->bloodkits()->count() > 0)

                    @if(!is_null(Auth::user()->donors()->first()->bloodkits()->first()->recieve_date) && Auth::user()->donors()->first()->bloodkits()->first()->status === 1)

                        <button type="button" class=" btn btn-light small border text-uppercase font-weight-bold" data-toggle="modal" data-target="#request-milkkit">
                            Request Milk Kit
                        </button>
                        <button type="button" class="btn btn-light small border text-uppercase font-weight-bold " data-toggle="modal" data-target="#pickup-message">
                            Schedule A Pickup
                        </button>

                    @endif
                @endif
            </div>


        </div>
    </div>
</div>
@include('site.blocks.donor-nav')
<div class="bg-white py-5">
    <div class="container">
       @if(Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row m-0 justify-content-center  mb-1">







            <div class="col-12 p-1">
                <div class=" bg-white text-dark border  p-5 row m-0 align-items-center justify-content-start">

                    <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Messages</span>({{$messages->count()}})</h6>
                    <button class="btn btn-light border text-uppercase  ml-auto font-weight-bold small" data-toggle="modal" data-target="#messageModal"><i class="fas fa-pen text-teal mr-1"></i> Write Message</button>
                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($messages as $k => $convo)
                                @if(Auth::user()->id == $convo->from_user_id && $convo->is_new_from_user == 1)
                                    @if($messages->count() > 1 && $k === 0)
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex border-bottom-0 align-items-center" href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment text-teal mr-1"></i> {{$convo->subject}}</span>

                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @else
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex " href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment text-teal mr-1"></i> {{$convo->subject}}</span>
                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @endif
                                @elseif(Auth::user()->id == $convo->to_user_id && $convo->is_new_to_user == 1)
                                    @if($messages->count() > 1 && $k === 0)
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex border-bottom-0 align-items-center" href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment text-teal mr-1"></i> {{$convo->subject}}</span>

                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @else
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex " href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment text-teal mr-1"></i> {{$convo->subject}}</span>
                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @endif
                                @else
                                    @if($messages->count() > 1 && $k === 0)
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex border-bottom-0 align-items-center" href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment  mr-1"></i> {{$convo->subject}}</span>

                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @else
                                        <a class="list-group-item rounded-0 text-dark row m-0 w-100 d-flex " href="{{url('/messages/message')}}?id={{$convo->id}}">
                                            <span><i class="fas fa-comment  mr-1"></i> {{$convo->subject}}</span>
                                            <span class="ml-auto">{{\App\User::where('id',$convo->from_user_id)->first()->first_name}} {{\App\User::where('id',$convo->from_user_id)->first()->last_name}}</span>
                                        </a>
                                    @endif
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>





        </div>
    </div>

</div>


@endsection
