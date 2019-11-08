@extends('admin.layouts.app')

@section('content')
 
<div class="bg-white h-100">
     <div class="bg-dark px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        <a href="/admin/page/update?id={{$data_item->id}}" class="btn btn-warning btn-sm ml-auto mr-1 text-white"><i class="fas fa-pencil-alt"></i> Edit Page</a>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete Page</button>
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
                    
                    <div class="col-12 row m-0">
                        <div class="col-6">
                            <div class="row m-0 bg-light border-top border-left border-right p-3">
                                <p class="m-0">Page Information</p>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                  
                                    <tr>
                                        <td class="">Title</td>
                                        <td>{{$data_item->title}}</td>
                                    </tr>

                                     <tr>
                                        <td class="">Slug</td>
                                        <td>{{$data_item->slug}}</td>
                                    </tr>
                                   
                                     <tr>
                                        <td class="">Template</td>
                                        <td>{{$data_item->template}}</td>
                                    </tr>

                                     <tr>
                                        <td class="">Content</td>
                                        <td>{!!$data_item->content!!}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td class="">Active</td>
                                        <td>{!!$data_item->active == true ? '<span class="badge badge-success rounded-0">Active</span>':'<span class="badge badge-danger rounded-0">Inactive</span>'!!}</td>
                                    </tr>

                                 
                                    <tr>
                                        <td class="">Created Date</td>
                                        <td>{{$data_item->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td class="">Updated Date</td>
                                        <td>{{$data_item->updated_at}}</td>
                                    </tr>
                                
                                </tbody>
                        </table>
                        </div>

                       
                    
                       @if($data_item->permissions()->count() > 0)
                        <div class="col-6">
                            <div class="row m-0 bg-light border border-bottom-0 p-3 align-items-center">
                                <p class="m-0">Page Permissions({{$data_item->permissions()->count()}})</p>
                                <a class="btn btn-primary btn-sm ml-auto" href="/admin/permission/create">Create Permission</a>
                            </div>
                            <table class="table bg-white border-left border-right">
                                <tbody>
                                    @foreach($data_item->permissions()->get() as $mk)
                                    <tr>
                                            <td><a href="/admin/permissions/permission?id={{$mk->id}}">{{$mk->name}}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        </div>
                        @endif

                        

                        

                       
                       

                         
                        
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header align-items-center bg-light rounded-0 p-0 p-3">
        <p class="modal-title m-0" id="exampleModalLabel">Delete Page</p>
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
        <a type="button" href="/admin/page/delete?id={{$data_item->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Delete</a>
      </div>
    </div>
  </div>
</div>
    
@endsection
