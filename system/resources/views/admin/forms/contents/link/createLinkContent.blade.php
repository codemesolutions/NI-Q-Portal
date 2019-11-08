<div class="modal fade in" id="createlink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="addinputfield" method="POST" action="{{Route('admin.forms.page.content.save')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Create Form Page Link Field</h6>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="modal" value="create-form-page"/>
            <input type="hidden" name="form" value="{{$form->id}}"/>
            <input type="hidden" name="page" value="{{isset($form_current_page->id) ? $form_current_page->id:''}}"/>
            <input type="hidden" name="type" value="link"/>
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
                      
                       
                        @if($errors->has('type') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('type') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                     <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="value"  class="link-url form-control form-control-lg {{$errors->has('value') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('value')}}"/>
                            @if($errors->has('value') && old('modal') === "create-form-page")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        </div>
                    <div class="mb-1 mt-1">

                    <a class="btn btn-primary" data-toggle="collapse" href="#internal" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Form Pages
                    </a>
                    </div>
                    <div class="collapse" id="internal">
                       
                          <div class="form-group">
                            <label>Form Pages</label>
                            <div style="max-height: 300px; overflow:auto;" class="select-box border bg-white ">
                                @foreach($form_pages as $fp)
                                    
                                    <div class="select-box-page-item  row m-0 border-bottom p-3 ">
                                        <div class="custom-control custom-checkbox ml-2">
                                            <input type="checkbox" class="custom-control-input" id="{{$fp->name}}" value="/form/page/{{$form->name}}/{{$fp->name}}">
                                            <label class="custom-control-label" for="{{$fp->name}}"></label>
                                        </div> 
                                        <p class="m-0 ml-4">{{$fp->name}}</p>
                                    </div>
                                   
                                @endforeach
                                
                            </div>
                            @if($errors->has('value') && old('modal') === "create-form-page")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('value') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="id"  class="form-control form-control-lg {{$errors->has('id') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('id')}}"/>
                    @if($errors->has('id') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Classes</label>
                        <input type="text" name="classes"  class="form-control form-control-lg {{$errors->has('classes') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('classes')}}"/>
                    @if($errors->has('classes') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('classes') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    
                  
                    <div class="form-group">
                        <label>Style</label>
                         <textarea name="style"  class="form-control form-control-lg {{$errors->has('style') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('style')}}"></textarea>
                    @if($errors->has('style') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('style') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>



                     <div class="form-group">
                        <label>Position</label>
                        <input type="number" min='0' name="position"  class="form-control form-control-lg {{$errors->has('position') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{old('position')}}"/>
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