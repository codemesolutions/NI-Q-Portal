@extends('admin.layouts.app')

@section('content')

<div class="bg-white h-100">
     <div class="bg-dark border-top px-3 py-1 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        @if(isset($previous))
            <a class="ml-3 btn btn-primary btn-sm" href="{{$previous}}">Back</a>
        @endif
        <button class="btn btn-primary btn-sm ml-auto small" data-toggle="modal" data-target="#messageModal"><i class="fas fa-reply"></i> Reply</button>
        <button class="btn btn-danger btn-sm ml-1 small" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete</button>
    </div>
    <div style="height: calc(100% - 36.2px);" class="overflow-auto">
      @if(Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class=" ">
                <div class="row  m-0 ">

                    <div class="col-12 p-0">
                        <div class="p-0">
                            @foreach($comments as $comment)
                                <div class="bg-light px-3 py-2  border-bottom-0 row m-0 align-items-center">
                                    <p>{!!$ticket->subject!!}</p>
                                    <p class="ml-auto small text-muted">{{\App\User::where('id', $comment->from_user_id)->first()->first_name. ' ' . App\User::where('id', $comment->from_user_id)->first()->last_name}}</p>
                                    <p class="small text-muted ml-auto">{{date('m-d-Y', strtotime($comment->created_at))}}</p>
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

                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header align-items-center bg-light rounded-0 p-0 p-3">
        <p class="modal-title m-0" id="exampleModalLabel">Delete Donor</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-3">
        <div class="row m-0 align-items-center">
            <div class="col-4 ">
                <h1 class="display-3 m-0 text-danger text-right"><i class="fas fa-exclamation-triangle"></i></h1>
            </div>
            <div class="col">
                <h5>Are you sure?</h5>
                <p>You are trying to delete a donor.  The donor will be given the status of inactive and archived.  Once this is done it cannot be undone.</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-thumbs-down"></i> Cancel</button>
        <a type="button" href="{{$delete_route}}?id={{$ticket->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Delete</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="modal-dialog rounded-0 modal-lg shadow-lg" action="{{Route('admin.message.reply')}}" method="post" enctype="application/x-www-form-urlencoded">
      <div class="modal-content rounded-0">
        <div class="modal-header d-none border-bottom-0 align-items-center bg-light rounded-0 p-0 px-3 py-2">
          <p class="modal-title m-0" id="exampleModalLabel">Reply</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-0">

                <style>
                    .ck-editor__editable_inline {
                        min-height: 300px;
                    }
                </style>
                <div class="" >
                    @csrf
                    <input type="hidden" name="ticket" value="{{$ticket->id}}">
                    <input type="hidden" name="from" value="{{$request->user()->id}}">
                    <input type="hidden" name="to" value="{{$ticket->from_user_id}}">
                    <textarea  name="message" id="editor"></textarea>

                </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger small mr-auto" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-dark small"><i class="fas fa-reply"></i> Send</a>
        </div>
      </div>
    </form>
  </div>

@endsection
