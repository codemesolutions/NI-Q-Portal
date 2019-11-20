@extends('admin.layouts.app')

@section('content')

<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        <a href="/admin/user/login?id={{$data_item->id}}" class="btn btn-danger btn-sm ml-auto mr-1 text-white"><i class="fas fa-lock mr-1"></i>Login As User</a>
        <a href="/admin/user/update?id={{$data_item->id}}" class="btn btn-warning btn-sm  mr-1 text-white"><i class="fas fa-pencil-alt"></i> Edit User</a>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete User</button>
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
        <div class=" ">
                <div class="row  m-0">

                    <div class="col-12 p-0 row m-0">
                        <div class="col-12 p-0">
                            <div class="border-bottom p-5">
                                <div class="row m-0 bg-gradient border-top border-left border-right p-3">
                                    <p class="m-0">User Information</p>
                                </div>
                                <table class="table bg-white border-left border-right">
                                    <tbody>

                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">First Name</td>
                                            <td>{{$data_item->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Last Name</td>
                                            <td>{{$data_item->last_name}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Email</td>
                                            <td>{{$data_item->email}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Cell Phone</td>
                                            <td>{{$data_item->cell_phone}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Home Phone</td>
                                            <td>{{$data_item->home_phone}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Active</td>
                                            <td>{!!$data_item->active == true ? '<span class="badge badge-success rounded-0">Active</span>':'<span class="badge badge-danger rounded-0">Inactive</span>'!!}</td>
                                        </tr>


                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Created Date</td>
                                            <td>{{$data_item->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Updated Date</td>
                                            <td>{{$data_item->updated_at}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>





                          @if($data_item->permissions()->count() > 0)
                        <div class="col-12 p-0">
                            <div class="p-5">
                                <div class="row m-0 bg-gradient border border-bottom-0 p-3">
                                    <p class="m-0">User Permissions({{$data_item->permissions()->count()}})</p>
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
        <p class="modal-title m-0" id="exampleModalLabel">Delete User</p>
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
        <a type="button" href="/admin/user/delete?id={{$data_item->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Delete</a>
      </div>
    </div>
  </div>
</div>

@endsection
