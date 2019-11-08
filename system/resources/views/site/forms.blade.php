@extends('site.layouts.app')

@section('content')

<div class=" jumbotron jumbotron-fluid bg-image py-5">
    <div class="container py-5 text-left">
        <div class="py-5 text-white">
                <h4 class="font-weight-light">Welcome, <span class=" font-weight-bold">{{Auth::user()->name}}</span></h4>
        </div>
    </div>
</div>
@include('site.blocks.donor-nav')
<div class="bg-white py-5">
    <div class="container p-5 bg-light border">
        <div class=" mb-4 px-3 d-none">
            <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-1 py-3" role="alert">
                <strong>Urgent Update Needed!</strong> We have not recieved your blood lab kit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        </div>
        <div class="row m-0 justify-content-center  mb-1">
            
        
            
            <div class="col-12 p-0 mb-3">
                <div class="row m-0 align-items-center">
                    @if(!is_null($request->user()->donors()->first()))
                    <h6 class = "pl-3 m-0 page-title">Forms <span class="text-danger">({{$request->user()->forms()->count()}})</span></h6>
                    @else
                    <h6 class = "pl-3 m-0 page-title">Forms <span class="text-danger">({{$request->user()->forms()->count()}})</span></h6>
                    @endif
                </div>
            </div>
         
        <div class="col-md-12 row m-0 mb-3 ">
                @if(isset($request) && !is_null($request->user()->forms()->first()))
                    @foreach ($request->user()->forms()->where('active', true)->get() as $form)
                        
                       
                        @if((is_null($form->submissions()->first()) || !$form->submissions()->first()->completed))
                            <div class="col-md-3 p-1">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            
                                            
                                            <div class="col-9 p-0">
                                            
                                                <a href="{{url('/donor/form?name='. $form->name) }}" class="row m-0 h-100 flex-column justify-content-center align-items-start">
                                                    <h6 class="title mb-1">{{$form->name}}</h6>
                                                    <span class="badge badge-danger rounded-0">Not Completed</span>
                                                </a>
                                            
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                         @elseif((!is_null($form->submissions()->first()) && $form->submissions()->first()->completed))
                            <div class="col-md-3 p-1">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            
                                            
                                            <div class="col p-0">
                                            
                                                <a href="{{url('/donor/form?name='. $form->name) }}" class="row m-0 h-100 flex-column justify-content-center align-items-start">
                                                    <h6 class="title mb-1">{{$form->name}}</h6>
                                                    <span class="badge badge-success rounded-0">completed</span>
                                                </a>
                                            
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                <div class="border  px-5 py-4 my-5 col-12 bg-white row mx-0 align-items-center">
                    <p class="m-0">Looks like you dont have any Forms at this time. </p>
                        
                </div>
                @endif
                
            </div>
            
        </div>
    </div>
</div>
@endsection
