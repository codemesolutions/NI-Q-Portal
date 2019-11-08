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
           <div class="row  m-0 ">
                    

                    <div class="col-12">
                         <h5 class="m-0 mb-5 page-title">Donor Blood Kits({{$donor->milkkits()->count()}})</h5>
                        @if($donor->bloodkits()->count() > 0)
                        <div class="">
                           
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($donor->bloodkits()->get() as $mk)
                                        @php $mk = $mk->toArray(); @endphp
                                        @foreach($mk as $col => $val)
                                            @if($col !== "id" && $col !== 'donor_id')
                                                @if($col == "active" || $col == "status")
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
                        @endif
                      
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
