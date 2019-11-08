
<div class="modal fade" id="create-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="" method="POST" action="{{Route('admin.forms.save')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Create Form</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form"/>
            <div class="row m-0 align-items-center bg-white border my-5 p-5">
                <div class=" col-12 ">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                    @if($errors->has('name') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description"  class="form-control form-control-lg {{$errors->has('description') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('description')}}"></textarea>
                    @if($errors->has('description') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mb-4">
                        <label>Form Type</label>
                        <select name="type"  class="form-control form-control-lg {{$errors->has('type') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{old('type')}}">
                            <option>Select the form type</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input name="approve" type="checkbox" class="custom-control-input" id="form-create-approve-1">
                            <label class="custom-control-label" for="form-create-approve-1">Requires Approval</label>
                        </div>
                    </div>
                
                    <div class="form-group ">
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="form-create-active-1">
                            <label class="custom-control-label" for="form-create-active-1">Active</label>
                        </div>
                    </div>

                     <div class=" col-12 mt-4 p-0">
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add Donors
                    </button>
                    <div class="collapse w-100 mt-4" id="collapseExample">
                        
                        <div style="max-height: 300px; overflow:auto;" class="select-box border">
                            @foreach($donors as $user)
                                <div class="select-box-item row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="donor[{{$user->id}}]" type="checkbox" class="custom-control-input" id="{{$user->first_name}}">
                                        <label class="custom-control-label" for="{{$user->first_name}}"></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$user->first_name . ' ' . $user->last_name}}</p>
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                    
                </div>
                
            </div>
            @csrf
            <div class="row m-0">
                
                <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Save changes</button>
            </div>
        </form>
        
      </div>
     
    </div>
  </div>
</div>
