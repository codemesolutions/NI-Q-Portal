<div class="modal fade in" id="edittextinput-pos-{{$field->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="addinputfield" method="POST" action="{{Route('admin.forms.page.field.update.position')}}">
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
            <input type="hidden" name="type" value="text"/>
            <input type="hidden" name="name" value="{{isset($field->name) ? $field->name:null}}" />

            <div class="row m-0 align-items-center bg-light border my-5 p-5">
                <div class=" col-12 ">
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