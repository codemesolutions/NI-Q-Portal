@extends('admin.layouts.app')

@section('content')
 
<div class="h-100 bg-light">
     <div class="bg-teal px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
        <div class="col p-0 form row m-0 ml-auto pl-5">
            <input type="search" name="search" class="form-control form-control-dark col table-search " placeholder="search"/>
           
                
            <div class="row align-items-center pl-5 m-0">
                @if(isset($show_map) && $show_map && isset($map_route))
                <a class="btn btn-warning text-white btn-sm ml-auto mr-1" href="{{$map_route}}"><i class="fas fa-sitemap"></i> map</a>
                @endif
                <a class="btn btn-primary btn-sm ml-auto" href="{{$create_route}}"><i class="fas fa-plus"></i> create</a>
                <button class="btn btn-danger btn-sm  ml-1 delete d-none " data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </div>
    </div>
    <div style="height: calc(100% - 66.2px);" class="overflow-auto">
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
        <div class="table-responsive  bg-white">

           <table id="example" class="table table-fixed w-100  searchable m-0" style="width:100%">
                <thead>
                    <tr>
                        <th  class="py-3 px-5">
                            <div class="custom-control custom-checkbox select-all">
                                <input type="checkbox" class="custom-control-input " id="customCheck1">
                                <label class="custom-control-label " for="customCheck1"></label>
                            </div>
                        </th>
                        @php $count = 1; @endphp
                        @foreach($datasets as $dataset)
                            @foreach ($dataset['columns'] as $column => $row)
                                <th onclick="sortable({{$count++}}, 'table.searchable')" class="py-3">{{$column}} <i class="fas fa-sort"></i></th>
                            @endforeach
                        @endforeach

                        
                    </tr>
                </thead>
                <tbody>

                    @foreach($datasets as $dataset)
                        @if(isset($dataset['rows']))
                            @foreach($dataset['rows'] as $user)
                           
                            <tr class="hover " data-href="{{$view_route}}?id={{$user->id}}">
                                <td class="px-5 clickable">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{$user->id}}">
                                        <label class="custom-control-label" for="{{$user->id}}"></label>
                                    </div>
                                </td>

                                @foreach($dataset['columns'] as $col => $row)
                                     @if(is_callable($row))
                                        <td class="clickable">{!!$row($user)!!}</td>
                                    @else
                                        <td class="clickable">{!!$user[$row]!!}</td>
                                    @endif
                                @endforeach
                               
                            </tr>

                            @endforeach
                        @endif
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
         @else
            <div class="mx-auto w-75 mt-5 p-5 text-center bg-white border">
                <h5 class="m-0">Uh Oh!.  Looks like there is no data available for display.</h5>
                <p class="mb-4 small text-muted">You can get started creating new records by clicking the button below</p>
                <a class="btn btn-primary px-4 mx-auto" href={{$create_route}}><i class="fas fa-plus"></i> Create</a>
            </div>
        @endif
    </div>
</div>

@endsection
