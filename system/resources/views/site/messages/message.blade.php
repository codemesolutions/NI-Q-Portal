@extends('site.layouts.app')

@section('content')

<div class=" jumbotron jumbotron-fluid bg-light border-top border-bottom py-0 ">
    <div class="container py-0 text-left">
        <div class="py-3 d-block d-md-flex m-0 w-100 align-items-center justify-content-center">
            <p class="font-weight-bold m-0 mr-md-auto mb-4 mb-md-0 d-none">Welcome, <span class=" font-weight-bold text-teal">{{Auth::user()->name}}</span></p>
            @if(!is_null(Auth::user()->donors()->first()))
            <p>Donor ID: <span class="text-muted">{{Auth::user()->donors()->first()->donor_number}}</span> </p>
            @endif
            @if(!is_null(Auth::user()->donors()->first()) && !is_null(Auth::user()->donors()->first()->bloodkits()->orderby('id', 'desc')->first()))
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
        <div class=" mb-4 px-3 d-none">
            <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-1 py-3" role="alert">
                <strong>Urgent Update Needed!</strong> We have not recieved your blood lab kit.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="row m-0 justify-content-center mb-5 mb-1">
            <div class="col-12 p-0 mb-4">
                <div class="row m-0 align-items-center">

                    <div class="col row m-0 align-items-center">
                        <a href="{{Route('messages')}}" class="btn btn-danger mr-3 btn-sm d-none"><i class="fas fa-caret-left"></i> Back</a>
                        <h6 class = "m-0 page-title">Message Thread: {{$ticket->subject}}<span class="text-danger"></span></h6>
                        <button class="btn btn-light border text-uppercase  ml-auto font-weight-bold small" data-toggle="modal" data-target="#replyModal"><i class="fas fa-reply text-teal mr-1"></i>Reply </button>


                    </div>
                </div>
            </div>


            <div class=" w-100 ">
            @foreach($comments as $comment)
                <div class="border shadow-sm bg-white mb-2">
                    <div class="bg-white px-3 py-2  border-bottom-0 row m-0 align-items-center">
                        <p>{!!$ticket->subject!!}</p>
                        @if($comment->from_user_id !== Auth::user()->id && is_null(Auth::user()->permissions()->where('name', 'admin')->first()))
                            <p class="ml-auto small text-muted font-weight-bold">NI-Q Support</p>
                        @else
                            <p class="ml-auto small text-muted font-weight-bold">{{\App\User::where('id', $comment->from_user_id)->first()->first_name. ' ' . App\User::where('id', $comment->from_user_id)->first()->last_name}}</p>
                        @endif
                        <p class="small text-muted ml-auto font-weight-bold">{{date('m-d-Y', strtotime($comment->created_at))}}</p>
                    </div>
                    <table class="table bg-light border-0 w-100 m-0">
                        <tbody>

                            <tr>

                                <td class="p-4 ">
                                    <p class=" front-weight-light m-0">{!!$comment->message!!}<p>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


            @endforeach
            </div>
            <button class="btn btn-light border text-uppercase  ml-auto font-weight-bold small" data-toggle="modal" data-target="#replyModal"><i class="fas fa-reply text-teal mr-1"></i>Reply </button>
        </div>
    </div>
</div>
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog rounded-0 modal-lg shadow-lg" action="{{Route('admin.message.reply')}}" method="post" enctype="application/x-www-form-urlencoded">
      <div class="modal-content rounded-0">
        <div class="modal-header  border-bottom-0 align-items-center bg-light shadow-sm rounded-0 p-0 px-3 py-2">
          <p class="modal-title m-0" id="exampleModalLabel">Message Reply</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4 bg-light ">

                <style>
                    .ck-editor__editable_inline {
                        min-height: 300px;
                    }
                </style>
                <div class="" >
                    @csrf
                    <div class="form-group">
                        <label>Subject</label>
                        <input class="form-control form-control-sm" disabled type="text" name="subject" value="{{$ticket->subject}}"/>
                    </div>
                    <input type="hidden" name="donor_message" value="1"/>
                    <input type="hidden" name="ticket" value="{{$ticket->id}}"/>
                    <input type="hidden" name="from" value="{{$request->user()->id}}">
                    <input type="hidden" name="to" value="{{$ticket->from_user_id}}">
                    <textarea  name="message" id="editor"></textarea>

                </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger small mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-dark small"><i class="fas fa-reply"></i> Send</button>
        </div>
      </div>
    </form>
</div>
@endsection
