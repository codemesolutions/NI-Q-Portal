@extends('site.layouts.app')


@section('content')
    @if($type == 'donor')
        @include('site.blocks.donor-heading')
        @include('site.blocks.donor-nav')
    @else

    @endif

    <div class="container my-5">
        <div class="p-5 border bg-white">
            @if($type == 'donor')
                <h5>{!!$title!!}</h5>
            @endif
            {!!$content!!}
        </div>
    </div>
@endsection
