@extends('admin.layouts.app')

@section('content')

<div class="h-100 bg-light">
     <div class="bg-gradient-dark border-bottom-dark px-3 py-1 border-top row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        <div class="col p-0 form row m-0 ml-auto pl-5">

            <div class="row align-items-center pl-5 m-0 ml-auto">
                @if(isset($show_map) && $show_map && isset($map_route))
                <a class="btn btn-warning text-white btn-sm ml-auto mr-1 small" href="{{$map_route}}"><i class="fas fa-sitemap"></i> map</a>
                @endif
                <a class="btn btn-primary btn-sm ml-auto small" href="{{$create_route}}"><i class="fas fa-plus"></i> Create Message</a>
                @if($request->path() == "donors")
                <a class="btn btn-warning btn-sm ml-3 small" href="/admin/donors/export">Export</a>
                @endif
                <button class="btn btn-danger btn-sm  ml-1 delete d-none small" data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </div>
    </div>
    <div style="height: calc(100% - 39.19px);" class="overflow-auto">
        @if(Session::has('success'))

            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
       @if(!is_null($datasets['list']['rows']) && $datasets['list']['rows']->count() > 0)



         @if(Session::has('message'))

            <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive  bg-white p-0">

           <table id="example" class="table table-fixed w-100  border-left border-right m-0 shadow" style="width:100%">

                <tbody>

                    @foreach($datasets as $dataset)
                        @if(isset($dataset['rows']))
                            @foreach($dataset['rows'] as $msg)

                            <tr class="hover " data-href="{{$view_route}}?id={{$msg->id}}">


                                @foreach($dataset['columns'] as $col => $row)
                                     @if(is_callable($row))
                                        <td class="clickable py-3 text-center">{!!$row($msg)!!}</td>
                                    @else
                                        <td class="clickable py-3 text-center">{!!$msg[$row]!!}</td>
                                    @endif
                                @endforeach

                            </tr>

                            @endforeach
                        @endif
                    @endforeach


                </tbody>
            </table>
            @if($dataset['rows'] instanceof \Illuminate\Pagination\LengthAwarePaginator)
            {{ $dataset['rows']->links() }}
            @endif
        </div>
         @else
            <div class="mx-auto w-50 mt-5 p-5 text-center">
                <h5 class="m-0">No Records Found!</h5>
                <p class="mb-4 small text-muted">You can get started creating new records by clicking the button below</p>
                <a class="btn btn-primary btn-sm px-4 mx-auto" href={{$create_route}}><i class="fas fa-plus"></i> Create</a>
            </div>
        @endif
    </div>
</div>

@endsection
