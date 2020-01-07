@extends('admin.layouts.app')

@section('content')

<div class="bg-image h-100">
     <div class="bg-dark px-3 py-1 row m-0 align-items-center border-top">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
        <a href="/admin/user/login?id={{$data_item->id}}" class="btn btn-danger btn-sm ml-auto mr-1 text-white small"><i class="fas fa-lock mr-1"></i>Login As User</a>
        <a href="/admin/user/update?id={{$data_item->id}}" class="btn btn-warning btn-sm  mr-1 text-white small"><i class="fas fa-pencil-alt"></i> Edit User</a>
        <button class="btn btn-danger btn-sm small" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete User</button>
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
                        <ul class="nav bg-dark border-top-dark align-items-center p-0  text-white" id="pills-tab" role="tablist">
                            <li class="nav-item border-right-dark">
                                <a class="nav-link text-white {{!$request->has('sub') ? 'active': ''}}" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Information</a>
                            </li>
                            <li class="nav-item border-right-dark">
                                <a class="nav-link text-white {{$request->has('sub') ? 'active show': ''}}" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Forms</a>
                            </li>
                        </ul>
                        <div class="tab-content bg-image" id="pills-tabContent">
                            <div class="tab-pane bg-image fade show {{!$request->has('sub') ? 'active': ''}}" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="">

                                    <table class="table bg-white border-left border-right m-0">
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
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Permissions</td>
                                                @if($data_item->permissions()->count() > 1)
                                                <td class="p-0">@foreach($data_item->permissions()->get() as $perm) <p class="border-bottom pl-3 py-1"><a href="/admin/permissions/permission?id={{$perm->id}}">{{$perm->name}}</a></p> @endforeach</td>
                                                @elseif($data_item->permissions()->count() === 1)
                                                <td class=""><a href="/admin/permissions/permission?id={{$data_item->permissions()->first()->id}}">{{$data_item->permissions()->first()->name}}</a></td>
                                                @elseif($data_item->permissions()->count() === 0)
                                                <td class="">None Assigned</td>
                                                @endif
                                            </tr>
                                            @if($data_item->donors()->count() >0)
                                            <tr>
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Donor Number</td>
                                                <td class="">{{$data_item->donors()->first()->donor_number}}</td>

                                            </tr>
                                            <tr>
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Mailing Address</td>
                                                <td class="">
                                                    <p>{{$data_item->donors()->first()->mailing_address}}</p>
                                                    <p>{{$data_item->donors()->first()->mailing_address2}}</p>
                                                    <span>{{$data_item->donors()->first()->mailing_city}},</span>
                                                    <span>{{$data_item->donors()->first()->mailing_state}},</span>
                                                    <span>{{$data_item->donors()->first()->mailing_zipcode}}</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Shipping Address</td>
                                                <td class="">
                                                    <p>{{$data_item->donors()->first()->shipping_address}}</p>
                                                    <p>{{$data_item->donors()->first()->shipping_address2}}</p>
                                                    <span>{{$data_item->donors()->first()->shipping_city}},</span>
                                                    <span>{{$data_item->donors()->first()->shipping_state}},</span>
                                                    <span>{{$data_item->donors()->first()->shipping_zipcode}}</span>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">Mailing City</td>
                                                <td class="">{{$data_item->donors()->first()->mailing_city}}</td>

                                            </tr>
                                            @endif

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
                            <div class="tab-pane bg-image fade {{!$request->has('sub') ? 'active': ''}}" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="">

                                    <table class="table  bg-white border-left border-right m-0">
                                        <tbody>

                                            @foreach($data_item->forms()->get() as $form)
                                                @php $submission = $form->submissions()->where('form_id', $form->id)->where('user_id', $data_item->id)->first(); @endphp
                                                @if(!is_null($submission))
                                                <tr>
                                                    <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;"><a class="text-dark" href="/admin/forms/submissions/submission?form={{App\Form::where('id', $submission->form_id)->first()->name}}&id={{$submission->id}}">{{App\Form::where('id', $submission->form_id)->first()->name}}</a></td>
                                                    <td>Completed: {{$submission->completed === 1 ? 'Yes':'No'}}</td>
                                                    <td>New: {{$submission->is_new === 1 ? 'Yes':'No'}}</td>
                                                    <td>Wait Listed: {{$submission->waited === 1 ? 'Yes':'No'}}</td>
                                                    <td>Disqualified: {{$submission->blocked === 1 ? 'Yes':'No'}}</td>
                                                    <td>Submission Date: {{date('m/d/Y', strtotime($submission->created_at))}}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </button>
                                                            <div class="dropdown-menu shadow p-0" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item border-bottom" href="/admin/forms/submissions/submission?form={{App\Form::where('id', $submission->form_id)->first()->name}}&id={{$submission->id}}"><i class="fas fa-eye mr-1"></i> View</a>
                                                                <a class="dropdown-item border-bottom" href="#"><i class="fas fa-sync mr-1"></i> Force Re-Submit</a>
                                                                <a class="dropdown-item" href="#"><i class="fas fa-lock mr-1"></i> Deny Submission</a>
                                                            </div>
                                                        </div>
                                                    </td>


                                                </tr>
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
