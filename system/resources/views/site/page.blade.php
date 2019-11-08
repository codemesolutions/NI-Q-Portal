@extends('site.layouts.app')


@section('content')
    @if($type == 'donor')
        @include('site.blocks.donor-heading')
        @include('site.blocks.donor-nav')
    @else
         <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <h1>{!!$title!!}</h1>
            </div>
        </div>
    @endif
   
    <div class="container my-5">
        <div class="p-5 ">
            {!!$content!!}
        </div>
    </div>
@endsection
