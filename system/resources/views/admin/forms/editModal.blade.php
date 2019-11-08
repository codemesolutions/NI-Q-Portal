<div class="modal fade" id="modal-{{$perm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content rounded-0 border-0">
        
        <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg">
        
             <form class="" method="POST" action="{{Route('admin.forms.update')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Edit Form</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="id" value="{{$perm->id}}"/>
            <input type="hidden" name="modal" value="create-form"/>
            <div class="row m-0 align-items-center bg-white border my-5 p-5">
                <div class=" col-12 ">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{$perm->name}}"/>
                    @if($errors->has('name') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description"  class="form-control form-control-lg {{$errors->has('description') && old('modal') === "create-permission" ? 'is-invalid':''}}" value="{{$perm->description}}"></textarea>
                    @if($errors->has('description') && old('modal') === "create-form")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mb-4">
                        <label>Form Type</label>
                        <select name="type"  class="form-control form-control-lg {{$errors->has('type') && old('modal') === "create-permission" ? 'is-invalid':''}}">
                            <option>Select the form type</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}" {{$perm->form_type_id == $type->id ? 'selected':''}}>{{$type->name}}</option>
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
                            <input name="approve" type="checkbox" class="custom-control-input" id="form-create-approve" {{$perm->requires_approval == true ? 'checked':''}}>
                            <label class="custom-control-label" for="form-create-approve">Requires Approval</label>
                        </div>
                    </div>
                
                    <div class="form-group ">
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="form-create-active" {{$perm->active == true ? 'checked':''}}>
                            <label class="custom-control-label" for="form-create-active">Active</label>
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