<div class="modal fade in" id="edittextinput-{{$field->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="addinputfield" method="POST" action="{{Route('admin.forms.page.field.update')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Edit Text Input</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form-page"/>
            <input type="hidden" name="form" value="{{$form->id}}"/>
            <input type="hidden" name="page" value="{{isset($form_page->id) ? $form_page->id:null}}"/>
             <input type="hidden" name="field" value="{{isset($field->id) ? $field->id:null}}"/>
            <input type="hidden" name="type" value="textarea"/>

            <div class="row m-0 align-items-center bg-light border my-5 p-5">
                <div class=" col-12 ">
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->name}}"/>
                    @if($errors->has('name') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                   
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="id"  class="form-control form-control-lg {{$errors->has('id') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->input_id}}"/>
                    @if($errors->has('id') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Classes</label>
                        <input type="text" name="classes"  class="form-control form-control-lg {{$errors->has('classes') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->class}}"/>
                    @if($errors->has('classes') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('classes') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Placeholder</label>
                        <input type="text" name="placeholder"  class="form-control form-control-lg {{$errors->has('placeholder') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->placeholder}}"/>
                    @if($errors->has('placeholder') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('placeholder') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Value</label>
                        <input type="text" name="value"  class="form-control form-control-lg {{$errors->has('value') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->value}}"/>
                    @if($errors->has('value') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('value') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Style</label>
                         <textarea name="style"  class="form-control form-control-lg {{$errors->has('style') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->style}}"></textarea>
                    @if($errors->has('style') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('style') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group">
                        <label>Label</label>
                        <input type="text" name="label"  class="form-control form-control-lg {{$errors->has('label') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->label}}"/>
                    @if($errors->has('label') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('label') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group">
                        <label>Helper Text</label>
                       
                        <textarea name="text"  class="form-control form-control-lg {{$errors->has('text') && old('modal') === "create-form-page" ? 'is-invalid':''}}">{{$field->helper_text}}</textarea>
                    @if($errors->has('text') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <input type="number" min='0' name="position"  class="form-control form-control-lg {{$errors->has('position') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$field->position}}"/>
                    @if($errors->has('position') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('position') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
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