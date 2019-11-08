@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3 row m-0 align-items-center">
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
                                        <td>{!!$val == "Inactive" ? '<span class="badge badge-danger rounded-0">Inactive</span>':'<span class="badge badge-success rounded-0">Active</span>'!!}</td>
                                    </tr>
                                    @else
                                        @if($name === 'form_type_id')
                                         <tr>
                                            <td>Form Type</td>
                                            <td>{{strip_tags($val)}}</td>
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

                    @if($data_item->users()->where('action', 'assign')->count() > 0)
                     <div class="col-12">
                        <div class="bg-light border p-3 border-bottom-0">
                            <p>Assigned Users</p>
                        </div>
                        <table class="table bg-white border-left border-right">
                            <tbody>
                                @foreach($data_item->users()->where('action', 'assign')->get() as $val)
                                
                                    <tr>
                                        <td>{{$val->first_name}}, {{$val->last_name}}</td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                    @endif

                    @if($data_item->questions()->count() > 0)
                     <div class="col">
                        <div class="bg-light border p-3 border-bottom-0 row m-0 align-items-center">
                            <p class="m-0">Form Questions</p>
                           
                            <a class="ml-1 btn btn-sm btn-primary ml-auto" href="/admin/forms/questions/create?id={{$data_item->id}}"><i class="fas fa-plus"></i> Create Question</a>
                        </div>
                        <table class="table bg-white border-left border-right">
                            <tbody>
                                @foreach($data_item->questions()->orderBy('order')->get() as $k => $val)

                                  
                                    <tr>
                                        <td ><span class="mr-2">#{{$k + 1}}. </span><a class="text-dark" href="/admin/forms/questions/question?id={{$val->id}}">{{strip_tags($val->question)}}</a></td>
                                        <td>{{$val->order}}</td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                    @endif

                     @if($data_item->submissions()->where('is_new', true)->where('completed', true)->count() > 0)
                     <div class="col-6">
                        <div class="bg-light border p-3 border-bottom-0">
                            <p>Form Submissions</p>
                        </div>
                        <table class="table bg-white border-left border-right text-center">
                            <tbody>
                                
                                @foreach($data_item->submissions()->where('is_new', true)->where('completed', true)->get() as $k => $val)
                                
                                    <tr>
                                        
                                        <td><span>#{{$k}}</span><a href="/admin/forms/submissions/submission?form={{$data_item->name}}&id={{$val->id}}">{{strip_tags($val->user_id->first_name)}}, {{strip_tags($val->user_id->last_name)}}</a></td>
                                        
                                      
                                        <td>{{strip_tags($val->user_id->created_at)}}</td>
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
