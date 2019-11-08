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
    <div class="container py-5 p-md-5 bg-light  border">
        
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
          
             <div class="col-12 row m-0 p-0">
                @if(isset($request) && !is_null($request->user()->forms()->where('action', 'assign')->first()))
                    @foreach ($request->user()->forms()->where('active', true)->where('action', 'assign')->get() as $form)
                        
                       
                        @if((is_null($form->submissions()->where('user_id', Auth::user()->id)->first()) || !$form->submissions()->where('user_id', Auth::user()->id)->first()->completed) && $form->questions()->count() > 0)
                            <div class="col-md-3 p-1">
                                <div class="card border" style="">
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
                         @elseif((!is_null($form->submissions()->first()) && $form->submissions()->first()->completed) && $form->questions()->count() > 0)
                            <div class="col-md-3 p-1">
                                <div class="card border" data-toggle="modal" data-target="#form-{{$form->id}}">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            
                                            
                                            <div class="col p-0">
                                            
                                                <a >
                                                    <h6 class="title mb-1">{{$form->name}}</h6>
                                                    <span class="badge badge-success rounded-0">completed</span>
                                                </a>

                                                <div class="modal fade rounded-0" id="form-{{$form->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content rounded-0">
                                                     <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel">Your <span class="font-weight-bold">Submission</span></h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        @php $count = 1; @endphp
                                                         @foreach($form->questions()->get() as $question)
                                                            <div class="">
                                                                <p class="mb-0 bg-light border-bottom-0 p-3 font-weight-bold">#{{$count++}}. &nbsp; {{ucfirst(strip_tags($question->question))}}</p>

                                                                <table class="table table-bordered bg-white m-0 border-0">
                                                                    <tbody>
                                                                        @php 
                                                                            $fcount = 1; 
                                                                            $fields = []; 
                                                                        @endphp
                                                                        @foreach($question->fields()->get() as $field)
                                                                            @php 
                                                                                $answer = \App\QuestionAnswer::where('question_id', $question->id)->where('field_id', $field->id)->where('user_id', Auth::user()->id)->first();
                                            
                                                                            @endphp
                                                                            @if(!is_null($answer) && !isset($fields[$field->name]))
                                                                                <tr>
                                                                                    @if($field['question_field_type_id']->id == 6)
                                                                                        @php 
                                                                                            $ext = pathinfo($answer->answer, PATHINFO_EXTENSION);
                                                                                        @endphp
                                                                                        @if($ext == "doc" || $ext === "docx")
                                                                                            <td class="pl-3"><iframe style="height: 500px;" class="w-100 border mb-3" src="https://docs.google.com/gview?url={{url('/')}}/file/{{$answer->answer}}&embedded=true" frameborder="0">
                                </iframe></td>
                                                                                        @else
                                                                                            <td class="pl-3"><a href="{{url('/')}}/file/{{$answer->answer}}">{{ucfirst($answer->answer)}}</a></td>
                                                                                        @endif
                                                                                        
                                                                                    @else
                                                                                        <td class="pl-3">{{ucfirst($answer->answer)}}</td>
                                                                                    @endif
                                                                                </tr>
                                                                        
                                                                            @endif  

                                                                            @php 
                                                                                if(!isset($fields[$field->name])){
                                                                                        $fields[$field->name] = $answer;
                                                                                }
                                                                            @endphp
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-danger btn-sm p-0 py-1 px-3" data-dismiss="modal">Close</button>
                                
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
              
                @endif
             </div>
            <div class="col-md-6 p-1">
                <div class=" bg-white  border  p-5 row m-0 align-items-center justify-content-start">
                   <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Notifications</span></h6>
                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($request->user()->notifications()->orderBy('created_at', 'desc')->limit(5)->get() as $convo)
                            <a class="py-2 rounded-0   border-bottom text-dark" href="{{$convo->resource}}">
                                <i class="fas fa-angle-right mr-3"></i> {{$convo->message}} <span class="small">{{date('h:i a m/d/Y', strtotime($convo->created_at))}}</span>
                            </a>
                            @endforeach
                    
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-1">
                <div class=" bg-white text-dark border  p-5 row m-0 align-items-center justify-content-start">
                   <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Messages</span></h6>
                    <div class="w-100 mt-4 ">
                        <ul class="list-group ">
                            @foreach($request->user()->conversations()->get() as $convo)
                            <a class="py-2 rounded-0   border-bottom text-dark" href="/messages/message?id={{$convo->id}}" >
                                <i class="fas fa-angle-right mr-3"></i>{{$convo->users()->where('users.id', '!=', $request->user()->id)->first()->name}}:&nbsp; "{{$convo->subject}}"     
                            </a>
                            @endforeach
                    
                        </ul>

                        
                    </div>
                </div>
            </div>
            @if(!is_null($request->user()->donors()->first()) && $request->user()->donors()->first()->milkkits()->count() > 0)
             <div class="col p-1">
                <div class=" bg-white  border  p-5 row m-0 align-items-center justify-content-start">
                   <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Milk Kits</span></h6>
                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($request->user()->donors()->first()->milkkits()->get() as $k => $mk)
                                <a class="p-2 rounded-0 mk border" data-toggle="collapse" href="#mk-{{$k}}">
                                    <i class="fas fa-angle-right mr-2"></i>Milk Kit #{{$mk->barcode}} - {{date('m-d-Y', strtotime($mk->received_date))}}
                                </a>
                                <div class="collapse w-100 bg-light p-3 border" id="mk-{{$k}}">
                                    <p><span class="font-weight-bold">Volume:  </span> {{$mk->volume}}</p>
                                    <p><span class="font-weight-bold">Received Date:  </span> {{date('m-d-Y', strtotime($mk->received_date))}} </p>
                                    @if(!is_null($mk->paid_date))
                                    <p><span class="font-weight-bold">Paid Date:  </span> {{date('m-d-Y', strtotime($mk->paid_date))}} </p>
                                    @endif
                                      
                                </div>
                            @endforeach
                    
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @if(!is_null($request->user()->donors()->first()) && $request->user()->donors()->first()->bloodkits()->count() > 0)
            <div class="col p-1">
                <div class=" bg-white  border  p-5 row m-0 align-items-center justify-content-start">
                   <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Blood Kits</span></h6>
                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($request->user()->donors()->first()->bloodkits()->get() as $k => $mk)
                                <a class="p-2 rounded-0 border mk" data-toggle="collapse" href="#bk-{{$k}}">
                                    <i class="fas fa-angle-right mr-2"></i>#{{$k + 1}}. &nbsp; {{$mk->tracking_number}}
                                </a>
                                 <div class="collapse w-100 bg-light p-3 border" id="bk-{{$k}}">
                                  
                                    <p><span class="font-weight-bold">Received Date:  </span> {{date('m-d-Y', strtotime($mk->received_date))}} </p>
                                    @if(!is_null($mk->order_date))
                                        <p><span class="font-weight-bold">Order Date:  </span> {{date('m-d-Y', strtotime($mk->order_date))}} </p>
                                    @endif
                                  
                                </div>
                               
                            @endforeach
                    
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
