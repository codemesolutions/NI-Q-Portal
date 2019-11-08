@extends('admin.layouts.app')

@section('content')

<div class="bg-light p-5">
    <div class="container p-5 bg-white border ">
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
                      
                        <h6 class = "p-0 m-0 page-title"><a class="mr-5 btn btn-primary" href="{{Route('admin.message')}}">Back</a> Conversation With: {{$message->user_id}}<span class="text-danger"></span></h6>
                        
                        
                        <button class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i> Trash</button>
                    </div>
                </div>
            </div>
        
           
            
            <div class="col-12 p-0 bg-light border">
                @if($message->messages()->count() > 0)
                    @foreach($message->messages()->get() as $child)
                        <div class=" w-100 px-3">
                            <div class="row m-0  bg-white  p-5">
                                <div class="row m-0 align-items-center w-100 pb-2">
                                    <div style="height: 20px; width: 20px;" class="bg-primary row m-0 align-items-center justify-content-center text-white">
                                        <p class="m-0">{{$request->user()->name[0]}}</p>
                                    </div>
                                    <div class="col">
                                        <div class="row m-0 align-items-center">
                                            <h5 class="m-0"> {{$child->title}}</h5>
                                            <p class="small m-0"><b>From:</b> {{$child->from_user_id}} - <span class="text-muted">12/19/2019</span></p>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-0 ">
                                    {!!$child->message!!}
                                </div>
                            
                            </div>
                        </div>
                    @endforeach
                
                @endif
            
            </div>
             <div class=" w-100">
                <div class="row m-0 ">
                    <div style="min-height: 300px;" class="col-12 p-0">
                        <form action = "{{Route('admin.message.reply')}}" method="post">
                            @csrf
                            <input type="hidden" name="parent" value="{{$message->id}}"/>
                            <input type="hidden" name="from" value="{{$request->user()->name}}"/>
                            <input type="hidden" name="to" value="{{$request->user()->name == $message->from_user_id ? $message->to_user_id: $message->from_user_id}}"/>
                            <input type="hidden" name="title" value="{{$message->title}}"/>
                            <textarea class="form-control" name="body" id="editor">
                                &lt;p&gt;Here goes the initial content of the editor.&lt;/p&gt;
                            </textarea>
                            <div class="row m-0">
                                <button type="submit" class="btn btn-primary ml-auto mt-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
<script>
   
</script>
@endsection
