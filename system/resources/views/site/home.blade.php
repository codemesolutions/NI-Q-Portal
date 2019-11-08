@extends('site.layouts.app')

@section('content')


@include('site.blocks.donor-nav')



<div class="bg-white pb-5">
    <div class="container p-5 bg-white border">
        
         @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('error'))

            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row m-0 justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="row m-0 align-items-center">
                    <h6 class = "m-0 page-title">Notifications <span class="text-danger">({{$request->user()->notifications()->count()}})</span></h6>
                    <div class="ml-auto p-0">
                        <h6 class="m-0 text-right ">Total <span class="page-title">Earnings:</span> <span class="text-teal ">$299.00</span></h6>
                    </div>
                </div>
                
            </div>
        
            
            <div class="col-12 p-0 mb-3 mt-4">
                <div class="row m-0 align-items-center">
                    
                    
                    <form class=" col row m-0 align-items-center mr-5">
                        <i class="fas fa-search text-muted" style="position:relative; left: 15px; z-index: 2;"></i>
                        <input style="padding-left: 45px; margin-left: -14px;" class="form-control search-form-control col" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <a class="btn btn-teal py-3 px-4" href="/milkkit/send?id={{$request->user()->id}}"><i class="fas fa-mail-bulk"></i> Request A Milk Kit</a>
                    <a class="btn btn-dark py-3 px-4 ml-3" href="{{Route('request.create')}}?id={{$request->user()->id}}"><i class="fas fa-mail-bulk"></i> Schedule A Pickup</a>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="row m-0 align-items-center">
                    <div class="col-6 p-0">
                        
                    </div>
                   
                </div>
                
            </div>
            <div class="col-md-12  notifications">
                @if(isset($request) && !is_null($request->user()->notifications()->first()))
                    @foreach ($request->user()->notifications()->get() as $note)
                        <a href="#" class="card bg-white  border mb-1" style="">
                            <div class="card-body">
                                <div class="row m-0 align-items-center">
                                   
                                
                                    
                                    <div style="width: 50px; height: 50px;" class="bg-teal p-3 text-center text-white rounded-0-0">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="row m-0 h-100 flex-column justify-content-center">
                                            <h6 class="title mb-1">&#64;{{$note->notification_type_id}} <p class="d-inline text m-0 font-weight-bold"> - {{$note->created_at}}</p></h6>
                                            <p class="text">{!!$note->message!!}</p>
                                        </div>
                                    
                                    </div>
                                
                                </div>
                                
                            </div>
                        </a>
                    @endforeach
                @endif
            
                
            </div>
            
        
        </div>
    </div>
</div>
@endsection
