@extends('site.layouts.app')


@section('content')

<div class="jumbotron jumbotron-fluid bg-teal  border-top">
    <div class="container py-3">
        <h6 class="m-0 text-white">{!!$title!!}</h6>
    </div>
</div>

<div class="bg-white">
    <div class="container py-5 p-md-5">
        <div class=" p-md-5">

            <div class="w-75 mx-auto answer border bg-white p-3 p-md-5">
               <h6 class="font-weight-bold mb-3  bg-light p-3 ">{{$disqualified_title}}</h6>
               <p>{{$disqualified_message}}</p>
                <a class="btn btn-teal mt-3" href="http://ni-q.com">Return to NI-Q</a>
            </div>

        </div>
    </div>
</div>
@endsection
