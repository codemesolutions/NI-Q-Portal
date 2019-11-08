@extends('site.layouts.app')


@section('content')
    
 <div class=" jumbotron jumbotron-fluid bg-image-200 py-5">
    <div class="container py-5">
       
    </div>
</div>

<div class="bg-white">
    
    <div class="container p-5">
        
        <div class=" p-5">
            <div class="w-75 mx-auto answer border p-5">
               <h6 class="font-weight-bold mb-3  bg-light p-3 ">{{$wait_title}} {{date('m-d-Y', strtotime($time))}}</h6>
                <p>{{$wait_message}}</p>
                <a class="btn btn-teal mt-3" href="http://ni-q.com">Return to NI-Q</a>
            </div>

        </div>
    </div>
</div>
@endsection
