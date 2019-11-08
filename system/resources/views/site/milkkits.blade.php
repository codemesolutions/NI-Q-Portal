@extends('site.layouts.app')

@section('content')


@include('site.blocks.donor-nav')



<div class="bg-white pb-5">
    <div class="container p-5 bg-light border">
        
         @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('error'))

            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(isset($donor))
           <div class="row bg-light m-0 ">
                    
                 
                    <div class="col-12">
                        <h5 class="m-0 mb-5 page-title">Donor Milk Kits({{$donor->milkkits()->count()}})</h5>
                       
                        <div class="">
                            
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->milkkits()->get() as $mk)
                                        @php $mk = $mk->toArray(); @endphp
                                        @foreach($mk as $col => $val)
                                            @if($col !== "id" && $col !== 'donor_id')
                                                @if($col == "active" || $col == "status" || $col == "closed" || $col == "transferred")
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val == 0 ? "false":"true"}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{$col}}</td>
                                                    <td>{{$val}}</td>
                                                </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
