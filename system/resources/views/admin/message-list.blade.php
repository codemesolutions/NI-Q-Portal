@extends('admin.layouts.app')

@section('content')
 
<div class="h-100">
     <div class="bg-teal  px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid   p-3 p-md-0" style="height:calc(100% - 52.2px);">
  
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

         @if(Session::has('message'))
           
            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row m-0 h-100">
            <div class="col-4 p-3 bg-white border-right h-100">
                <div class="form row m-0 mb-3">
                        <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
                    
                            
                        <div class="row align-items-center pl-5 m-0">
                            <a class="btn btn-primary btn-lg ml-auto" href="{{$create_route}}"><i class="fas fa-plus"></i></a>
                            <button class="btn btn-danger px-4 ml-1 delete d-none " data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i></button>
                        </div>
                </div>
                <div class="list-group rounded-0" id="list-tab" role="tablist">
                    @foreach($datasets as $dataset)
                       
                        @foreach($dataset['rows'] as $convo)
                            
                            
                            <a data-id = "{{$convo->id}}" class="list-group-item list-group-item-action rounded-0 {{$convo->is_seen ? 'bg-light':''}}" id="list-home-list" data-toggle="list" href="#{{str_replace(' ', '_', $convo->subject.$convo->id)}}" role="tab" aria-controls="home"><span class="bg-primary d-inline-block text-center text-white mr-2" style="height: 20px; width: 20px;">{{$convo->subject[0]}}</span> {{$convo->subject . ' - ' . $convo->users()->where('users.id', '!=', $request->user()->id)->first()->name}}</a>
                         
                           
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="col-8 p-0 h-100" style="">
                <div class="tab-content bg-light h-100" id="nav-tabContent">
                     @foreach($datasets as $dataset)
                        @php $count = 0; @endphp
                        @foreach($dataset['rows'] as $convo)
                          
                            <div  class="tab-pane fade h-100" id="{{str_replace(' ', '_', $convo->subject.$convo->id)}}" role="tabpanel" aria-labelledby="list-home-list">
                                <div style="height: calc(100% - 154.2px); overflow:auto;" class="row m-0 p-5">
                                    @foreach($convo->messages()->orderBy('created_at', 'asc')->get() as $message)
                                        <div class="row m-0 w-100">
                                            @if($message->from_user_id === $request->user()->name)
                                                <div class="col-8 ml-auto bg-white border p-3 m-1">
                                                    <p><span style="height: 20px; width: 20px;" class="bg-primary d-inline-block text-center mr-2 text-white">{{$message->from_user_id[0]}} </span>{{$message->from_user_id}} - <span class="small text-muted">{{$message->created_at}}</span></p>
                                                  
                                                    <div class="text-muted small">{!!$message->message!!}</div>

                                                </div>
                                            @elseif($message->to_user_id === $request->user()->name)
                                                <div class="col-8 bg-white border p-3 m-1">
                                                    <p><span style="height: 20px; width: 20px;" class="bg-primary d-inline-block text-center mr-2 text-white">{{$message->from_user_id[0]}} </span> {{$message->from_user_id}}  - <span class="small text-muted">{{$message->created_at}}</span></p>
                                                    
                                                    <div class="text-muted small">{!!$message->message!!}</div>

                                                </div>

                                        
                                            @else
                                                <div class="col-8 bg-white border p-3 m-1">
                                                    <p><span style="height: 20px; width: 20px;" class="bg-primary d-inline-block text-center mr-2 text-white">{{$message->from_user_id[0]}} </span> {{$message->from_user_id}}  - <span class="small text-muted">{{$message->created_at}}</span></p>
                                                    
                                                    <div class="text-muted small">{!!$message->message!!}</div>

                                                </div>

                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="w-100">
                                    <form class="m-0 w-100 p-0 bg-white border-bottom" action="{{Route('admin.message.reply')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="to" value="{{$message->from_user_id}}"/>
                                        <input type="hidden" name="conversation" value="{{$convo->id}}"/>
                                        <textarea name = "message" id="editor" placeholder="write your message here" class="form-control border-left-0 border-right-0 border-top border-bottom" name="message"></textarea>
                                        <button class="btn btn-primary btn-block py-3" type="submit">Send</button>

                                    </form>
                                </div>
                            </div>
                           
                           
                            
                        @endforeach
                         @php $count++ @endphp
                    @endforeach
                </div>
               
            </div>
        </div>

    
    </div>
</div>
@endsection
