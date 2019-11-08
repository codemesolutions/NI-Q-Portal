@extends('admin.layouts.app')

@section('content')
 
<div class=" ">
    <div class="bg-white border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
   
    <div class="container-fluid p-5">
         
       @if($forms->count() > 0)
        <div class="form row m-0 mb-5 ">
            <input type="search" name="search" class="form-control form-control-lg col table-search " placeholder="search"/>
            <div class="row pl-5 m-0">
            <button class="btn btn-primary px-4 ml-auto" data-toggle="modal" data-target="#create-form"><i class="fas fa-plus"></i></button>
            <button class="btn btn-danger px-4 ml-1 delete d-none " data-toggle="modal" data-target="#create-form"><i class="fas fa-trash"></i></button>
            </div>
        </div>
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="table-responsive border bg-white h-100 ">

           <table id="example" class="table table-fixed w-100  searchable  m-0" style="width:100%">
                <thead>
                    <tr>
                        <th  class="py-4 px-5">
                            <div class="custom-control custom-checkbox select-all">
                                <input type="checkbox" class="custom-control-input " id="customCheck1">
                                <label class="custom-control-label " for="customCheck1"></label>
                            </div>
                        </th>
                        <th onclick="sortable(1, 'table.searchable')" class="py-4">Name <i class="fas fa-sort"></i></th>
                        
                        <th onclick="sortable(2, 'table.searchable')" class="py-4">Form Type <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(3, 'table.searchable')" class="py-4">Form Link <i class="fas fa-sort"></i></th>
                         <th onclick="sortable(4, 'table.searchable')" class="py-4">Status <i class="fas fa-sort"></i></th>
                        <th onclick="sortable(5, 'table.searchable')" class="py-4">Created Date <i class="fas fa-sort"></i></th>
                       
                        <th onclick="" class="py-4">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($forms as $perm)
                    <tr class="">
                        <td class="px-5">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$perm->name}}">
                                <label class="custom-control-label" for="{{$perm->name}}"></label>
                            </div>
                        </td>
                        <td>{{$perm->name}}</td>
                        <td>{{$perm->formType()->where('id', $perm->form_type_id)->first()->name}}</td>
                        <td> @php $pageID = $perm->pages()->count() > 0 ? $perm->pages()->first()->name:'' @endphp
                            <a class="" href="{{url('/form/page/'. $perm->name.'/'.  $pageID) }}"><i class="fas fa-external-link-alt"></i> View</a></td>
                         @if($perm->active == 1)
                            <td><span class='text-success'>Active</span></td>
                        @else
                             <td><span class='text-danger'>Inactive</span></td>
                        @endif
                        
                        <td>{{$perm->created_at}}</td>

                        <td>
                           
                            <a class="btn btn-info btn-sm" href="{{Route('admin.forms.submissions')}}?id={{$perm->id}}"><i class="fas fa-clipboard-list px-1"></i></a>
                            <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#modal-info-{{$perm->id}}"><i class="far fa-eye"></i></button>
                            <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-{{$perm->id}}"><i class="fas fa-pen"></i></button>
                            <a class="btn btn-danger btn-sm" href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    @include('admin.forms.editModal')

                    <div class="modal fade" id="modal-info-{{$perm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content rounded-0 border-0 bg-white">
                                
                                <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
                                    <div class="row m-0">
                                        <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white"></i> Form</h6>
                                        <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                     
                                     <div class="info-container bg-white border p-5 mt-4">
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Name</p>
                                            <p class="m-0 ml-4">{{$perm->name}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Description</p>
                                            <p class="m-0 ml-4">{{$perm->description}}</p>
                                        </div>
                                         <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Requires Approval</p>
                                            <p class="m-0 ml-4">{{$perm->requires_approval == 1 ? "Yes":"No"}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Status</p>
                                            <p class="m-0 ml-4">{{$perm->active == 1 ? "Active":"Inactive"}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Created Date</p>
                                            <p class="m-0 ml-4">{{$perm->created_at}}</p>
                                        </div>
                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Last Modified Date</p>
                                            <p class="m-0 ml-4">{{$perm->updated_at}}</p>
                                        </div>

                                        <div class="row m-0 border-bottom py-3">
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Form Pages ({{$perm->pages()->count()}})</p>
                                            <div class="row m-0  ml-4">
                                                @foreach ($perm->pages()->get() as $pages)
                                                    <p class="col-12 p-0">{{$pages->name}}({{''}})</p>
                                                @endforeach
                                                <p></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row m-0  py-3">
                                            @if(Schema::hasTable($perm->table_name))
                                            <p style="font-weight: 700;" class="m-0 col-4 text-uppercase">Submissions ({{DB::table($perm->table_name)->count()}})</p>
                                            <a class="btn btn-primary btn-sm" href="#">View Submissions</a>
                                            @endif
                                        </div>
                                          
                                     </div>

                                      
                                    

                                </div>
                                
                            </div>
                        </div>
                    </div>

                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    @else
        <div class="mx-auto w-75 mt-5 p-5 text-center">
            <h5 class="m-0">Looks like you have not created or recieved any forms</h5>
            <p class="mb-4 small text-muted">You can get started creating a form by clicking the button below.</p>
            <button class="btn btn-primary px-4 mx-auto" data-toggle="modal" data-target="#create-form"><i class="fas fa-plus"></i> Create Form</button>
        </div>
    @endif
    </div>
</div>

@include('admin.forms.createModal')

@endsection
