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
                @if(!is_null(Auth::user()->donors()->first()) &&
                    Auth::user()->donors()->first()->bloodkits()->count() > 0 &&
                    Auth::user()->id !== 2329 &&
                    Auth::user()->id !== 1083 &&
                    Auth::user()->id !== 2707 &&
                    Auth::user()->id !== 2181)

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

        <div class="d-none alert alert-warning alert-dismissible fade show mb-4 rounded-0 " role="alert">
            Schedule a pickup is under construction.  Please drop of your Milk Kit at the nearest FedEX Drop Off Location Monday - Thursday 7:30am to 5pm.  We apoligize for any inconvience this may cause.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="d-none alert alert-info alert-dismissible fade show mb-4 rounded-0 " role="alert">
            Ni-Q waiting for Shipping Supplies. The milk kit request tab will remain unavailable until supplies are replenished. Thank you for your patience.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-info alert-dismissible fade show mb-1 rounded-0 " role="alert">
            Thank you for being a donor, Ni-Q is maintaining business as usual. Ni-Q will be shipping out milk kits and receiving donations. Ni-Q asks that you take extra precaution to making sure you and your equipment is cleaned on a regular basis. Ni-Q thanks all of you for your efforts during this time.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-info alert-dismissible fade show mb-1 rounded-0 " role="alert">
            Latest update to breast feeding information and the corona virus! <a href="https://www.cdc.gov/coronavirus/2019-ncov/specific-groups/pregnancy-guidance-breastfeeding.html">Read More!</a>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-info alert-dismissible fade show mb-4 rounded-0 " role="alert">
            We have updated our W9 form process and we need everyone to please re-complete your w9 form.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row m-0 justify-content-center">

             <div class="col-12 row m-0 p-0">
                @if(isset($request) && !is_null($request->user()->forms()->where('action', 'assign')->first()))
                    @foreach ($request->user()->forms()->where('active', true)->where('action', 'assign')->get() as $form)


                        @if((is_null($form->submissions()->where('user_id', Auth::user()->id)->first()) || !$form->submissions()->where('user_id', Auth::user()->id)->first()->completed) && $form->questions()->count() > 0)
                            <div class="col-md-3 p-1">
                                <div class="card border " style="">
                                    <div class="card-body">
                                        <div class="row m-0">


                                            <div class="col-9 p-0">

                                                <a href="{{url('/donor/form?name='. $form->name) }}" class="row m-0 h-100 flex-column justify-content-center align-items-start">
                                                    <h6 class="title mb-1 text-uppercase">{{$form->name}}</h6>
                                                    <span class="badge badge-danger rounded-0">Not Completed</span>
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                         @elseif((!is_null($form->submissions()->first()) && $form->submissions()->first()->completed) && $form->questions()->count() > 0)
                            <div class="col-md-3 p-1">
                                <div class="card border " data-toggle="modal" data-target="#form-{{$form->id}}">
                                    <div class="card-body">
                                        <div class="row m-0">


                                            <div class="col p-0">

                                                <a >
                                                    <h6 class="title mb-1 text-uppercase">{{$form->name}}</h6>
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
                                                        @if($form->name !== "NI-Q Consent Form")
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
                                                        @else
                                                            @foreach($form->questions()->get() as $question)
                                                                @foreach($question->fields()->get() as $field)
                                                                    @php
                                                                        $answer = \App\QuestionAnswer::where('question_id', $question->id)->where('field_id', $field->id)->where('user_id', Auth::user()->id)->first();
                                                                    @endphp
                                                                    @if(!is_null($answer) && !isset($fields[$field->name]))
                                                                        @php
                                                                        $ext = pathinfo($answer->answer, PATHINFO_EXTENSION);
                                                                        @endphp

                                                                        @if($ext == "doc" || $ext === "docx")
                                                                        <td class="pl-3">
                                                                            <iframe style="height: 500px;" class="w-100 border mb-3" src="https://docs.google.com/gview?url={{url('/')}}/file/{{$answer->answer}}&embedded=true" frameborder="0"></iframe>
                                                                        </td>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach

                                                        @endif
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
            <div class="col-md-6 p-1 d-none">
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
            <div class="col-md-6 p-1 d-none">
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
            @if(!is_null($request->user()->donors()->first()) && $request->user()->donors()->first()->milkkits()->whereNotNull('received_date')->count() > 0)
             <div class="col p-1">
                <div class=" bg-white  border  p-5 row m-0 align-items-center justify-content-start">

                   <h6 class="font-weight-light m-0"><span class="font-weight-bold">Milk Kits</span></h6>
                   <div class="col d-none p-0 row m-0 justify-content-end">
                        <p class="ml-md-3">Milk Kits Request: <span class="text-muted">{{Auth::user()->donors()->first()->milkkits()->count()}}</span> </p>
                        <p class="ml-md-3">Milk Kits Recieved: <span class="text-muted">{{Auth::user()->donors()->first()->milkkits()->count()}}</span> </p>
                        <p class="ml-md-3">Total Volume: <span class="text-muted">{{Auth::user()->donors()->first()->milkkits()->count()}}</span> </p>
                    </div>

                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($request->user()->donors()->first()->milkkits()->get() as $k => $mk)
                                @if(!is_null($mk->received_date))
                                <a class="p-2 rounded-0 mk border" data-toggle="collapse" href="#mk-{{$k}}">
                                    <i class="fas fa-angle-right mr-2"></i>Milk Kit #{{$mk->barcode}} - {{date('m-d-Y', strtotime($mk->received_date))}}
                                </a>
                                <div class="collapse w-100 bg-light p-3 border" id="mk-{{$k}}">
                                    @if(!is_null($mk->finalized_date))
                                        <p><span class="font-weight-bold">Volume:  </span> {{$mk->volume}}</p>
                                    @endif
                                    @if(!is_null($mk->received_date))
                                        <p><span class="font-weight-bold">Received Date:  </span> {{date('m-d-Y', strtotime($mk->received_date))}} </p>
                                    @endif
                                    @if(!is_null($mk->finalized_date))
                                        @if( $mk->genetic_test_results == 1 && $mk->microbial_test_results == 1 && $mk->toxicology_test_result == 1)
                                            <p><span class="font-weight-bold">Testing:  </span> <span class="text-success">Passed </span></p>
                                        @else
                                            <p><span class="font-weight-bold">Testing: </span> <span class="text-danger">Failed </span></p>
                                        @endif
                                    @endif
                                    @if(!is_null($mk->finalized_date))
                                        <p><span class="font-weight-bold">Finalized Date:  </span> {{$mk->finalized_date}}</p>
                                    @endif

                                    @if(!is_null($mk->paid_date))
                                    <p><span class="font-weight-bold">Paid Date:  </span> {{date('m-d-Y', strtotime($mk->paid_date))}} </p>
                                    @endif

                                </div>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @if(!is_null($request->user()->donors()->first()) && $request->user()->donors()->first()->bloodkits()->where('status', true)->count() > 0)
            <div class="col p-1 d-none">
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
