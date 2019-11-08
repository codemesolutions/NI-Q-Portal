<div class="modal fade in" id="createtextinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="addinputfield" method="POST" action="{{Route('admin.forms.page.field.save')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Create Form Page</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form-page"/>
            <input type="hidden" name="form" value="{{$form->id}}"/>
            <input type="hidden" name="page" value="{{isset($form_current_page->id) ? $form_current_page->id:null}}"/>
           
            <div class="row m-0 align-items-center bg-light border my-5 p-5">
                <div class=" col-12 ">
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('name')}}"/>
                    @if($errors->has('name') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                     <div class="form-group">
                        <label>Type</label>
                        <select class="form-control form-control-lg  {{$errors->has('type') && old('modal') === "create-form-page" ? 'is-invalid':''}}" name="type">
                            <option value='input.text'>Text</option>
                            <option value='input.search'>Search</option>
                            <option value='input.checkbox'>Checkbox</option>
                            <option value='input.radio'>Radio</option>
                            <option value='input.password'>Password</option>
                            
                        </select>
                       
                        @if($errors->has('type') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                   
                    <div class="form-group mt-4">
                        <label>ID</label>
                        <input type="text" name="id"  class="form-control form-control-lg {{$errors->has('id') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('id')}}"/>
                    @if($errors->has('id') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4">
                        <label>Classes</label>
                        <input type="text" name="classes"  class="form-control form-control-lg {{$errors->has('classes') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('classes')}}"/>
                    @if($errors->has('classes') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('classes') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4">
                        <label>Placeholder</label>
                        <input type="text" name="placeholder"  class="form-control form-control-lg {{$errors->has('placeholder') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('placeholder')}}"/>
                    @if($errors->has('placeholder') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('placeholder') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4">
                        <label>Value</label>
                        <input type="text" name="value"  class="form-control form-control-lg {{$errors->has('value') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('value')}}"/>
                    @if($errors->has('value') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('value') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4">
                        <label>Style</label>
                         <textarea name="style"  class="form-control form-control-lg {{$errors->has('style') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('style')}}"></textarea>
                    @if($errors->has('style') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('style') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group mt-4">
                        <label>Label</label>
                        <input type="text" name="label"  class="form-control form-control-lg {{$errors->has('label') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('label')}}"/>
                    @if($errors->has('label') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group mt-4">
                        <label>Helper Text</label>
                        <textarea name="text"  class="form-control form-control-lg {{$errors->has('text') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('name')}}"></textarea>
                    @if($errors->has('text') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                     <div class="form-group mt-4">
                        <label>Position</label>
                        <input type="number" min='0' name="position"  class="form-control form-control-lg {{$errors->has('position') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('position')}}"/>
                        @if($errors->has('position') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group mt-4" id="validation">
                        <label>Validation Rules</label>
                        <div style="max-height: 300px; overflow:auto;" class="select-box border bg-white ">
                            @foreach($validation_rules as $fp)
                                
                                <div class="select-box-item  row m-0 border-bottom p-3 ">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input type="checkbox" class="custom-control-input" name="rules[{{$fp->id}}]" id="{{$fp->name}}" value="{{$fp->id}}">
                                        <label class="custom-control-label" for="{{$fp->name}}"></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$fp->name}}</p>
                                </div>
                                
                            @endforeach
                            
                        </div>
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                   
                     <button class="btn btn-primary mt-4" type="button" data-toggle="collapse" data-target="#map" aria-expanded="false" aria-controls="collapseExample">
                        Add Field Map
                    </button>
                  
                    <div class="collapse mt-3" id="map">
                        <label>Tables/Column Map</label>
                         <select name="map" class="form-control form-control-lg">
                                @foreach($tables as $table)
                                    @foreach( Schema::getColumnListing($table) as $col)
                                       
                                        <option>{{$table. ':' . $col}}</option>
                                       
                                    @endforeach
                                @endforeach
                            </select>
                    </div>
                   
                </div>
                
            </div>
            @csrf
            <div class="row m-0"> 
                <button type="submit" class="btn btn-primary btn-lg btn-block  py-3 ">Save changes</button>
            </div>
        </form>
      </div>
     
    </div>
  </div>
</div>