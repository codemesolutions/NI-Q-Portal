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
    <div class="container p-5 bg-light border ">
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

                    <h6 class="font-weight-light m-0"> Your <span class="font-weight-bold">Messages</span></h6>
                      <div class="col row m-0">
                        <button class="btn btn-teal btn-sm ml-auto" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-pen"></i> New Message</button>
                        <button class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                    <div class="w-100 mt-4 ">

                        <ul class="list-group ">
                            @foreach($request->user()->conversations()->get() as $convo)
                                <a class="list-group-item rounded-0 text-dark" href="{{url('/messages/message')}}?id={{$convo->id}}"><span class="bg-teal d-inline-block text-center text-white mr-2 text-uppercase" style="height: 30px; width: 30px; line-height: 30px;">{{$convo->subject[0]}}</span>{{$convo->subject . ' - ' .$convo->users()->where('users.id', '!=', $request->user()->id)->first()->name}}</a>
                            @endforeach
                    
                        </ul>
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
                <form class="w-100 p-5" method="POST" action="{{Route('messages.create')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label>To</label>
                        <select name="user" style="height: 50px;" class="custom-select">
                            @foreach($users as $user)
                                @if(!is_null($user->permissions()->where('name', 'Admin')->first()))
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                            
                        </select>
                        <p class="small text-muted">Select the user you want to message</p>
                    </div>
                     <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="title"  class="form-control form-control-lg {{$errors->has('title') && old('modal') === "createuser" ? 'is-invalid':''}}" value="{{old('title')}}"/>
                        @if($errors->has('title') && old('modal') === "createuser")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4">
                        <label>Message</label>
                        <textarea id="editor" name="body"  class="editor {{$errors->has('body') && old('modal') === "createuser" ? 'is-invalid':''}}">{{old('body')}}</textarea>
                        @if($errors->has('body') && old('modal') === "createuser")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
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
