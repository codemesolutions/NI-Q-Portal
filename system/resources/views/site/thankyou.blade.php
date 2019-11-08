@extends('site.layouts.app')


@section('content')
    
<div class=" jumbotron jumbotron-fluid bg-image py-5">
    <div class="container py-5 text-left">
        <div class="py-5 text-white">
            <h4 class="font-weight-bold">Thank you</h4>
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="container p-5">
        <div class=" p-5">
           
          <div class="w-75 mx-auto answer border bg-white p-5">
               <h6 class="font-weight-bold mb-3  bg-light p-3 ">{{$ty_title}}</h6>
               <p>{{$ty_message}}</p>
                <a class="btn btn-teal mt-3" href="http://ni-q.com">Return to NI-Q</a>
            </div>


        </div>
    </div>
</div>
@endsection
