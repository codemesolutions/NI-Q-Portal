@extends('admin.layouts.app')

@section('content')

<div class="bg-white h-100">
     <div class="bg-gradient-dark border-bottom-dark border-top px-3 py-3 row m-0 align-items-center">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
         @if($data_item->questions()->count() == 0)
         <a class="ml-1 btn btn-sm btn-primary ml-auto" href="/admin/forms/questions/create?id={{$data_item->id}}">Create Question</a>
         @else
         <a class="ml-auto btn btn-sm btn-danger ml-auto" href="/admin/forms/questions/map?id={{$data_item->id}}"><i class="fas fa-map"></i> Map Form</a>
         <a href="/form?name={{$data_item->name}}" class="btn btn-primary btn-sm ml-1  text-white"><i class="fas fa-eye"></i> Preview Form</a>
         @endif
        <a href="/admin/form/update?id={{$data_item->id}}" class="btn btn-warning btn-sm ml-1 mr-1 text-white"><i class="fas fa-pencil-alt"></i> Edit Form</a>
        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i> Delete Form</button>
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
        <ul class="nav  align-items-center p-0 shadow position-relative " id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{!$request->has('sub') ? 'active': ''}} text-dark" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{$request->has('sub') ? 'active show': ''}}" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Submissions</a>
            </li>
        </ul>
        <div class="tab-content bg-image" id="pills-tabContent">
            <div class="tab-pane bg-image fade show {{!$request->has('sub') ? 'active': ''}}" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row  m-0 align-items-stretch">
                    <div class="col-12 p-0">
                        <div class="  p-5">
                            <div class="bg-gradient border p-3 border-bottom-0">
                                <p>Information</p>
                            </div>
                            <table class="table bg-white border-left border-right m-0">
                                <tbody>
                                    @foreach($data_item->toArray() as $name => $val)
                                        @if($name == 'active')
                                            <tr>
                                                <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid; border-bottom: #ddd 1px solid;">{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                <td>{!!$val == "Inactive" ? '<span class="badge badge-danger rounded-0">Inactive</span>':'<span class="badge badge-success rounded-0">Active</span>'!!}</td>
                                            </tr>
                                        @else
                                            @if($name === 'form_type_id')
                                                <tr>
                                                    <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid;border-bottom: #ddd 1px solid;">Form Type</td>
                                                    <td>{{strip_tags($val)}}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td style="width: 200px;background: #f5f5f5; border-right: #ddd 1px solid;border-bottom: #ddd 1px solid;">{{ucfirst(str_replace('_', ' ', $name))}}</td>
                                                    <td>{{strip_tags($val)}}</td>
                                                </tr>
                                            @endif
                                        @endif

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($data_item->questions()->count() > 0)
                        <div class="col p-0 m-0">
                            <div class=" h-100">
                                <div class="bg-gradient  p-3 border row m-0 align-items-center">
                                    <p class="m-0">Form Questions</p>

                                    <a class="ml-1 btn  btn-primary btn-sm ml-auto small" href="/admin/forms/questions/create?id={{$data_item->id}}"><i class="fas fa-plus"></i> Create Question</a>
                                </div>
                                <div style="max-height: 300px; overflow:auto;" class="">

                                    <table class="table table-bordered bg-white border-left border-right m-0">
                                        <tbody>
                                            @foreach($data_item->questions()->orderBy('order')->get() as $k => $val)


                                                <tr>
                                                    <td>#{{$k + 1}}.</td>
                                                    <td ><span class="mr-2"> </span><a class="text-dark" href="/admin/forms/questions/question?id={{$val->id}}">{{strip_tags($val->question)}}</a></td>
                                                    <td>{{$val->order}}</td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    @endif


                    @if($data_item->users()->where('action', 'assign')->count() > 0)
                        <div class="col p-0 m-0">
                            <div class="p-5 ">
                                <div class="bg-white border  p-3 bg-gradient" >
                                    <p>Assigned Users</p>
                                </div>
                                <div style="height: 300px; overflow:auto;" class="">

                                    <table class="table bg-white border-left border-right m-0">
                                        <tbody>
                                            @foreach($data_item->users()->where('action', 'assign')->get() as $val)

                                                <tr>
                                                    <td>{{$val->first_name}}, {{$val->last_name}}</td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    @endif


                    @if($data_item->submissions()->where('is_new', true)->where('completed', true)->count() > 0)
                        <div class="col-12 p-0">
                            <div class="p-5  ">
                                <div class="bg-gradient border  p-3 border-bottom-0">
                                    <p>Form Submissions</p>
                                </div>
                                <table class="table bg-white border-left border-right text-center m-0">
                                    <tbody>

                                        @foreach($data_item->submissions()->where('is_new', true)->where('completed', true)->get() as $k => $val)
                                            @if(!is_null($val->user_id))
                                                <tr>
                                                    <td>#{{$k + 1}}.</td>
                                                    <td><a href="/admin/forms/submissions/submission?form={{$data_item->name}}&id={{$val->id}}">{{strip_tags($val->user_id->first_name)}}, {{strip_tags($val->user_id->last_name)}}</a></td>


                                                    <td>{{strip_tags($val->created_at)}}</td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endif


                </div>
            </div>

            <div class="tab-pane fade bg-image {{$request->has('sub') ? 'active show': ''}}" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                @if($data_item->submissions()->where('is_new', true)->where('completed', true)->count() > 0)
                    <div class="col-12 p-0 pb-5">
                        <div class="p-5 ">
                            <div class="shadow-lg">
                                <div class="bg-gradient border  p-3 border-bottom-0 row m-0 align-items-center">
                                    <p>Submissions</p>

                                </div>
                                <table class="table bg-white border-left border-right  m-0">
                                    <tbody>

                                        @foreach($subs as $k => $val)
                                            @if(!is_null($val->user_id))
                                                <tr>

                                                    <td><a href="/admin/forms/submissions/submission?form={{$data_item->name}}&id={{$val->id}}">{{strip_tags($val->user_id->first_name)}}, {{strip_tags($val->user_id->last_name)}}</a></td>
                                                    <td>{{$val->is_new == true ? "New":""}}</td>
                                                    <td>{{$val->completed == true ? "Completed":""}}</td>
                                                    <td>{{$val->blocked == true ? "Disqualified":""}}</td>
                                                    <td>{{$val->waited == true ? "Wait Listed":""}}</td>

                                                    <td>{{date('m-d-Y', strtotime($val->user_id->created_at))}}</td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row m-0 justify-content-center">
                        {{ $subs->appends(['id' => $data_item->id, 'sub' => 1])->links() }}
                        </div>
                    </div>

                @endif
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
