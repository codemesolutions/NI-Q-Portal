<div class="modal fade" id="editpage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <form class="" method="POST" action="{{Route('admin.forms.page.update')}}">
             <div class="row m-0">
                <h6 class="m-0 text-uppercase" > <i class="fab fa-wpforms p-3 bg-primary text-white "></i> Edit Form Page</h6>
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
                        <input type="text" name="name"  class="form-control form-control-lg {{$errors->has('name') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$form_current_page->name}}"/>
                    @if($errors->has('name') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="url"  class="form-control form-control-lg {{$errors->has('url') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$form_current_page->url}}"/>
                        @if($errors->has('url') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description"  class="form-control form-control-lg {{$errors->has('description') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$form_current_page->description}}"></textarea>
                    @if($errors->has('description') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>

                    <div class="form-group">
                        <label>Keywords</label>
                        <textarea name="keywords"  class="form-control form-control-lg {{$errors->has('keywords') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$form_current_page->keywords}}"></textarea>
                    @if($errors->has('keywords') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('keywords') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                    </div>
                    <div class="form-group">
                         <label>Redirect URL</label>
                        <input type="text" name="redirect"  class=" link-url form-control form-control-lg {{$errors->has('redirect') && old('modal') === "create-form-page" ? 'is-invalid':''}}" value="{{$form_current_page->redirect_url}}"/>
                        @if($errors->has('redirect') && old('modal') === "create-form-page")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('redirect') }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">Your name you want to have displayed on the system.</p>
                        <div style="max-height: 300px; overflow:auto;" class="select-box border bg-white ">
                                @foreach($form_pages as $fp)
                                    
                                    <div class="select-box-page-item  row m-0 border-bottom p-3 ">
                                        <div class="custom-control custom-checkbox ml-2">
                                            <input type="checkbox" class="custom-control-input" id="{{$fp->name}}" value="{{url('/')}}/form/page/{{$form->name}}/{{$fp->name}}">
                                            <label class="custom-control-label" for="{{$fp->name}}"></label>
                                        </div> 
                                        <p class="m-0 ml-4">{{$fp->name}}</p>
                                    </div>
                                   
                                @endforeach
                                
                            </div>
                    </div>
                    <div class="form-group mt-4">
                        
                        <div class="custom-control custom-checkbox">
                            <input name="active" type="checkbox" class="custom-control-input" id="form-create-active" {{$form_current_page->active == true ? 'checked':''}}>
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