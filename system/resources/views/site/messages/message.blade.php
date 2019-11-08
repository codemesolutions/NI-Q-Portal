@extends('site.layouts.app')

@section('content')

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
        <div class="row m-0 justify-content-center mb-5 mb-1">
            <div class="col-12 p-0 mb-4">
                <div class="row m-0 align-items-center">
                
                    <div class="col row m-0 align-items-center">
                        <a href="{{Route('messages')}}" class="btn btn-danger mr-3 btn-sm d-none"><i class="fas fa-caret-left"></i> Back</a>
                        <h6 class = "m-0 page-title">Message Thread: {{$message->subject}}<span class="text-danger"></span></h6>
                        
                        
                        
                    </div>
                </div>
            </div>
        
           
            <div class=" w-100 ">
             @foreach($message->messages()->orderBy('created_at', 'asc')->get() as $child)
                <div class="row m-0 w-100 align-items-start mb-2">
                    @if($child->from_user_id === $request->user()->name)
                        <div class="col-12  bg-white border p-5">
                            <p class="mb-3 text-dark font-weight-bold bg-light p-3"><span style="height: 30px; width: 30px; line-height:30px;" class="bg-teal d-inline-block text-center mr-2 text-white">{{$child->from_user_id[0]}} </span>{{$child->from_user_id}} - <span class="small text-muted">{{$child->created_at}}</span></p>
                            
                            <div class="text-dark ">{!!$child->message!!}</div>

                        </div>
                    @elseif($child->to_user_id === $request->user()->name)
                        <div class="col-12 ml-auto bg-white border p-5 ">
                            <p class="mb-3 text-dark font-weight-bold bg-light p-3"><span style="height: 30px; width: 30px; line-height:30px;" class="bg-teal d-inline-block text-center mr-2 text-white">{{$child->from_user_id[0]}} </span> {{$child->from_user_id}}  - <span class="small text-muted">{{$child->created_at}}</span></p>
                            
                            <div class="text-dark ">{!!$child->message!!}</div>

                        </div>

                
                    @else
                        <div class="col-12 bg-white border p-5 ">
                            <p><span style="height: 30px; width: 30px; line-height:30px; bg-light p-3" class="bg-teal d-inline-block text-center mr-2 text-white">{{$child->from_user_id[0]}} </span> {{$child->from_user_id}}  - <span class="small text-muted">{{$child->created_at}}</span></p>
                            
                            <div class="text-dark ">{!!$child->message!!}</div>

                        </div>

                    @endif

                  
                </div>
            @endforeach
             <form class="m-0 w-100 p-0 bg-light " action="{{Route('admin.message.reply')}}" method="post">
                    @csrf
                    <input type="hidden" name="to" value="{{$child->from_user_id}}"/>
                    <input type="hidden" name="conversation" value="{{$message->id}}"/>
                    <textarea name = "message" id="editor" placeholder="write your message here" class="form-control border-top-0" name="message"></textarea>
                    <button class="btn btn-teal btn-block  py-3 " type="submit">Send</button>

                </form>
            </div>
             
            <div class="collapse w-100" id="collapseExample">
                <div class=" w-100 px-3">
                    <div class="row m-0  bg-white border p-5">
                        <div class="row m-0 align-items-center w-100 pb-4">
                            <div style="height: 60px; width: 60px;" class="bg-teal row m-0 align-items-center justify-content-center text-white">
                                {{$message->from_user_id[0]}}
                            </div>
                            <div class="col">
                                <div class="">
                                    <h5 class="m-0"><i class="fas fa-reply text-teal mr-2"></i> {{$message->title}}</h5>
                                    <p class="small m-0 pt-2 ml-2"><b>From:</b>  {{$message->from_user_id[0]}} - <span class="text-muted">12/19/2019</span></p>
                                    
                                </div>
                            </div>
                        </div>

                        <div style="min-height: 300px;" class="col-12 p-0">
                            <form action = "{{Route('messages.create')}}" method="post">
                                @csrf
                                <input type="hidden" name="parent" value="{{$message->id}}"/>
                                <input type="hidden" name="to" value="{{$message->from_user_id}}"/>
                             
                                <input type="hidden" name="title" value="{{$message->title}}"/>
                                <textarea class="form-control" name="body" id="editor">
                                    &lt;p&gt;Here goes the initial content of the editor.&lt;/p&gt;
                                </textarea>
                                <div class="row m-0">
                                    <button type="submit" class="btn btn-teal ml-auto mt-4">Send</button>
                                </div>
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-xl rounded-0" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl rounded-0">
        <div class="modal-content rounded-0">
            <div style="border-top: #12c9dd 5px solid;" class="modal-header bg-dark rounded-0 row m-0 align-items-center">
                <h6 class="modal-title text-white" id="exampleModalLabel">New message</h6>
                <button style="text-shadow:none;" type="button" class="btn " data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
            <div class="row m-0">
                <form class="w-100 p-5" method="POST" action = "{{Route('admin.message.create')}}">
                    <div class="form-group mb-4">
                        <label>User</label>
                        <select style="height: 50px;" class="custom-select">
                            <option selected>NI-Q Support</option>
                            <option value="1">English</option>
                            <option value="2">Spanish</option>
                            <option value="3">French</option>
                            
                        </select>
                        <p class="small text-muted">Select the user you want to message</p>
                    </div>
                    <div class="form-group mb-4">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control py-4" placeholder="subject of your message"/>
                        <p class="small text-muted">The subject of your message.</p>
                    </div>
                    <div class="form-group mb-4">
                        <label>Subject</label>
                        
                    </div>
                    <div class="row m-0 w-100 mt-5">
                        <button class="btn btn-teal ml-auto">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
 <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@endsection
