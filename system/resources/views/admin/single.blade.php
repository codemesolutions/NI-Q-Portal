@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        @if(isset($previous))
        <a class="ml-3 btn btn-primary btn-sm" href="{{$previous}}">Back</a>
        @endif
        <a href="{{$update_route}}?id={{$data_item->id}}" class="btn btn-warning btn-sm ml-auto mr-1 text-white"><i class="fas fa-pencil-alt"></i> Edit</a>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete</button>
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
      @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container-fluid ">
                <div class="row  m-0 mt-4">
                    <div class="col-12">
                        <div class="bg-light border p-3 border-bottom-0">
                            <p>{!!$title!!}</p>
                        </div>
                        <table class="table bg-white border-left border-right">
                            <tbody>
                                @foreach($data_item->toArray() as $name => $val)
                                    
                                    @if($name == 'active')
                                        <tr>
                                            <td>{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                            <td>{!!$val === 0 || $val === "Inactive" ? '<span class="badge badge-danger rounded-0">Inactive</span>':'<span class="badge badge-success rounded-0">Active</span>'!!}</td>
                                        </tr>
                                    @else
                                        @if($name == 'form_id')
                                            <tr>
                                                <td>{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                <td>{{strip_tags($val['name'])}}</td>
                                            </tr>
                                         @elseif($name == 'has_why_field')
                                            <tr>
                                                <td>{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                <td>{{$val == 0 ? 'No':'Yes'}}</td>
                                            </tr>
                                        @elseif($name == 'additional_info_field')
                                            <tr>
                                                <td>{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                <td>{{$val == 0 ? 'No':'Yes'}}</td>
                                            </tr>
                                        
                                        @else
                                             <tr>
                                                <td>{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                <td>{{strip_tags($val)}}</td>
                                            </tr>
                                        @endif
                                    @endif
                                    
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header align-items-center bg-light rounded-0 p-0 p-3">
        <p class="modal-title m-0" id="exampleModalLabel">Delete Donor</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-3">
        <div class="row m-0 align-items-center">
            <div class="col-4 ">
                <h1 class="display-3 m-0 text-danger text-right"><i class="fas fa-exclamation-triangle"></i></h1>
            </div>
            <div class="col">
                <h5>Are you sure?</h5>
                <p>You are trying to delete a donor.  The donor will be given the status of inactive and archived.  Once this is done it cannot be undone.</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-thumbs-down"></i> Cancel</button>
        <a type="button" href="{{$delete_route}}?id={{$data_item->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Delete</a>
      </div>
    </div>
  </div>
</div>
    
@endsection
