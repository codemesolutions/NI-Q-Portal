@extends('admin.layouts.app')

@section('content')

@if(Session::has('message'))
<div class="alert alert-danger m-0 rounded-0">
    {{Session::get('message')}}
</div>
@endif

@if(!Session::has('message'))
<div style="height: 100%;" class="form-editor">
@else
<div style="height: calc(100% - 126px);" class="form-editor">
@endif
    <div class="row m-0 form-editor-container">
        <div class="form-editor-sidebar">
            <div class="form-title">
                 <h6 class="m-0">Form: <span class="text-primary">{{$form->name}}</span></h6>
                <div class="dropdown ml-auto">
                    <button class="btn text-white btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu  dropdown-menu-right rounded-0" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Edit Form</a>
                        <a class="dropdown-item" href="#">Delete Form</a>
                        <div class="dropdown-divider"></div>
                        <a data-toggle="modal" data-target="#addpage" class="dropdown-item" href="#">Add Page</a>
                        <a class="dropdown-item" href="#">Delete Pages</a>
                        
                       
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Hide Sidebar</a>
                        
                    </div>
                </div>
            </div>
            @if(isset($form_pages) && $form_pages->count() > 0)
            <div class="form-editor-sidebar-block">
                <div class="row m-0">
                    <h6 class="text-primary mt-1">Form Pages</h6>
                    
                    <div class="dropdown ml-auto">
                        <button class="btn text-white btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu  dropdown-menu-right rounded-0" aria-labelledby="dropdownMenuButton">
                            <a data-toggle="modal" data-target="#addpage" class="dropdown-item" href="#">Add Page</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Hide Section</a>
                            
                        </div>
                    </div>
                </div>
                <div class="nav flex-column">
                    @if(isset($form_pages))
                        
                        @foreach($form_pages as $fp)
                            <a class="nav-item" href="{{Route('admin.forms.create')}}?id={{$form->id}}&page={{$fp->id}}">{{$fp->name}}<button class="btn btn-sm text-white ml-auto"><i class="fas fa-times"></i></button></a>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif
            @if(isset($form_current_page))
            <div class="form-editor-sidebar-block">
                <div class="row m-0 ">
                    <h6 class="text-primary mt-1">Form Page Fields</h6>
                    
                </div>
                <div class=" nav flex-column ">
                    
                        @foreach($form_current_page->fields()->get() as $field)
                            <a class="nav-item" href="#">&lt;{{$field->type}}&gt; - {{$field->name}} <button class="btn btn-sm text-white ml-auto"><i class="fas fa-times"></i></button></a>
                        @endforeach
                
                    
                  
                </div>
            </div>
            @endif
        </div>
        <div class="form-editor-surface">
            <div class="row m-0 form-editor-toolbar align-items-center">
                @if(isset($form_pages) && $form_pages->count() > 0)
                <div class="dropdown">
                    
                    <button class="btn text-white btn-sm  dropdown-toggle border-right-dark px-3" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Page: <span class="text-primary">{{$form_current_page->name}}</span> <i class="fas fa-sort-down"></i>
                    </button>
                    <div class="dropdown-menu  dropdown-menu-left rounded-0" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editpage">Edit Page</a>
                        <a class="dropdown-item" href="#">Delete Page</a>
                        <div class="dropdown-divider"></div>
                         <a href="{{Route('admin.forms.page.preview')}}?id={{$form->id}}&page={{$form_current_page->id}}" class="dropdown-item ">Preview Page</a>
                        <div class="dropdown-divider"></div>
                        <a data-toggle="modal" data-target="#addpage" class="dropdown-item" href="#">Add Page</a>
                        
                        
                    </div>
                </div>
               
                @endif
                 <button data-toggle="modal" data-target="#addpage" class="btn text-white  btn-sm   px-3"><i class="fas fa-plus text-success"></i> Add Page</button>
                 @if(isset($form_current_page))
                
                 <a href="{{Route('admin.forms.build')}}?id={{$form->id}}" class="btn text-white ml-auto"><i class="fas fa-save text-success"></i> Save</a>
                 @endif
            </div>
            
            <div class="row m-0 form-editor-container-editable p-0">
                
                <div class="form-editor-editable  m-0 col row p-0">
                    <div class="form-editor-editable-surface" ondrop="drop(event)" ondragover="allowDrop(event)">
                        @if(isset($form_current_page))
                            @foreach($form_current_page->fields()->orderBy('position', 'asc')->get() as $field)
                                <div class="editor-field form-group">
                                    <div class="row m-0 align-items-center controls">
                                        <p class="">Name: <span class="text-primary">{{$field->name}}</span></p>
                                        <p class="ml-4">Type: <span class="text-primary">{{$field->type}}</span></p>
                                        <button class="edit-field btn btn-sm btn-white ml-auto text-muted" data-toggle="modal" data-target="#edittextinput-{{$field->id}}"><i class="fas fa-pen"></i></button>
                                        <a href="{{Route('admin.forms.page.field.delete')}}?form={{$form->id}}&page={{$form_current_page->id}}&field={{$field->id}}" class="edit-field btn btn-sm btn-white ml-1  text-muted"><i class="fas fa-trash"></i></a>
                                        <button class="edit-field btn btn-sm btn-white ml-1 text-muted" data-toggle="modal" data-target="#edittextinput-pos-{{$field->id}}"><i class="fas fa-sort"></i></button>
                                    </div>
                                    <div class="editor-field-content">
                                    @if($field->type === 'input.text' || $field->type === 'input.password' || $field->type === 'input.search' || $field->type === 'input.checkbox' || $field->type === 'input.radio')
                                        @if(!is_null($field->label))
                                            <label>{{$field->label}}</label>
                                        @endif
                                        <input style="{{$field->style}}" class="{{$field->class}}" type="{{$field->type}}" name="{{$field->name}}" value="{{$field->value}}" placeholder="{{$field->placeholder}}"/>
                                        <p class="small text-muted">{{$field->helper_text}}</p>

                                    @elseif($field->type === 'select')
                                        @if(!is_null($field->label))
                                            <label>{{$field->label}}</label>
                                        @endif
                                        <select style="{{$field->style}}" class="{{$field->class}}" type="{{$field->type}}" name="{{$field->name}}" value="{{$field->value}}" placeholder="{{$field->placeholder}}">
                                            @foreach(explode(',', $field->options) as $option)
                                                @if(strpos($option, '*') !== false)
                                                    @if(strpos($option, ':') !== false)
                                                        @php 
                                                            $option = explode(':', $option);
                                                        @endphp

                                                        <option selected value="{{str_replace('*', '', $option[0])}}">{{str_replace('*', '', $option[1])}}</option>
                                                    @else
                                                        <option selected value="{{str_replace('*', '', $option)}}">{{str_replace('*', '', $option)}}</option>
                                                    @endif
                                                @else
                                                    @if(strpos($option, ':') !== false)
                                                        @php 
                                                            $option = explode(':', $option);
                                                        @endphp

                                                        <option value="{{$option[0]}}">{{$option[1]}}</option>
                                                    @else
                                                        <option value="{{$option}}">{{$option}}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        <p class="small text-muted">{{$field->helper_text}}</p>
                                        
                                        
                                    @elseif($field->type === 'textarea')
                                        <label>{{$field->label}}</label>
                                        <textarea style="{{$field->style}}" class="{{$field->class}}" type="{{$field->type}}" name="{{$field->name}}" placeholder="{{$field->placeholder}}">{{$field->value}}</textarea>
                                        <p class="small text-muted">{{$field->helper_text}}</p>
                                    @elseif($field->type === 'h1')
                                        <div class="editor-content">
                                            <h1 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h1>
                                        </div>
                                    @elseif($field->type === 'h2')
                                        <div class="editor-content">
                                            <h2 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h2>
                                        </div>
                                     @elseif($field->type === 'h3')
                                        <div class="editor-content">
                                            <h3 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h3>
                                        </div>
                                     @elseif($field->type === 'h4')
                                        <div class="editor-content">
                                            <h4 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h4>
                                        </div>
                                      @elseif($field->type === 'h5')
                                        <div class="editor-content">
                                            <h5 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h5>
                                        </div>
                                     @elseif($field->type === 'h6')
                                        <div class="editor-content">
                                            <h6 id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</h6>
                                        </div>
                                     @elseif($field->type === 'p')
                                        <div class="editor-content">
                                            <p id={{$field->input_id}} style={{$field->style}} class={{$field->class}}>{{$field->value}}</p>
                                        </div>

                                    @elseif($field->type === 'button')
                                        <div class="editor-content row m-0">
                                            <button type="button" id={{$field->input_id}} style="{{$field->style}}" class="{{$field->class}}">{{$field->value}}</button>
                                        </div>
                                     @elseif($field->type === 'button.submit')
                                        <div class="editor-content row m-0">
                                            <button type="submit" id={{$field->input_id}} style="{{$field->style}}" class="{{$field->class}}">{{$field->value}}</button>
                                        </div>
                                    @elseif($field->type === 'link')
                                        <div class="editor-content row m-0">
                                            <a id="{{$field->input_id}}" style="{{$field->style}}" class="{{$field->class}}" href="{{$field->value}}">{{$field->name}}</a>
                                        </div>
                                    
                                    @endif
                                    </div>
                                    
                                </div>
                               
                                @include('admin.forms.inputs.text.editTextInput')
                                @include('admin.forms.inputs.text.editTextInputPosition')
                                
                              
                                @include('admin.forms.inputs.textarea.editTextarea')
                                @include('admin.forms.inputs.textarea.editTextareaPosition')
                            @endforeach

                            @include('admin.forms.inputs.text.createTextInput')
                            @include('admin.forms.inputs.textarea.createTextarea')
                            @include('admin.forms.contents.header.createHeaderContent')
                            @include('admin.forms.contents.buttons.createButtonContent')
                            @include('admin.forms.contents.link.createLinkContent')
                            @include('admin.forms.inputs.selects.createSelectInput')
                        @endif
                    </div>
                </div>
                <div class="form-editor-element-panel">
                     @if(isset($form_current_page))
                    <div class="input">
                        
                        <div class="tab-content p-3" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <h6 class="col-12 p-0"><i class="fas fa-keyboard text-primary"></i> Input Fields</h6>
                                <div class="row m-0  align-items-stretch tab-content-block mb-4">
                                    <div class="col-12  flex-fill">
                                        <button class="btn btn-primary btn-block h-100 "  data-toggle="modal" data-target="#createtextinput"><i class="fas fa-i-cursor text-primary"></i> Text Input</button>
                                    </div>
                                    <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100 addtextareabutton" data-toggle="modal" data-target="#createtextarea"><i class="fas fa-edit text-primary"></i> Textarea</button>
                                    </div>
                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100 addtextareabutton"><i class="fas fa-upload text-primary"></i> File Upload</button>
                                    </div>
                                    
                                </div>

                                <h6 class="col-12  p-0"><i class="fas fa-hand-pointer text-primary"></i> Select Fields</h6>
                                <div class="row m-0  align-items-stretch tab-content-block mb-4">
                                   
                                   
                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100" data-toggle="modal" data-target="#createselectinput"><i class="fas fa-mouse-pointer text-primary" ></i> Select Dropdown</button>
                                    </div>
                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"><i class="fas fa-mouse-pointer text-primary"></i> Multi Select</button>
                                    </div>
                                   
                                </div>

                                <h6 class="col-12 p-0 "><i class="fas fa-newspaper text-primary"></i> Additional Fields</h6>
                                <div class="row m-0  align-items-stretch tab-content-block mb-4">
                                   
                                    <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"  data-toggle="modal" data-target="#createHeaderContent"><i class="fas fa-paragraph text-primary"></i> Add Text</button>
                                    </div>
                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"><i class="fas fa-image text-primary"></i> Image</button>
                                    </div>
                                    <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"><i class="fas fa-video text-primary"></i> Video</button>
                                    </div>

                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100" data-toggle="modal" data-target="#createbutton"><i class="fas fa-square text-primary"></i> Button</button>
                                    </div>
                                      <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100" data-toggle="modal" data-target="#createlink"><i class="fas fa-anchor text-primary"></i> Link</button>
                                    </div>

                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"><i class="fas fa-table text-primary"></i> Table</button>
                                    </div>

                                     <div class="col-12 ">
                                        <button class="btn btn-primary btn-block h-100"><i class="fas fa-file-alt text-primary"></i> Document</button>
                                    </div>
                                  
                                </div>
                               
                              
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div>
                                
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.forms.page.create')

@if(isset($form_current_page))
@include('admin.forms.page.edit')
@endif

<div class="modal fade in" id="createpages" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content  border-0 bg-white ">
      
      <div class="modal-body  border p-3 p-md-5 bg-white shadow-lg ">
       
        <h5 class="mb-0">Now that we have created your form lets get started in adding some content.</h5>
        <p class="text-muted mb-3">you can begin by clicking the button below to add your first form page.</p>
         <button  data-toggle="modal-close-open" data-close="#createpages" data-target="#addpage" class="btn btn-primary btn-block text-white  btn-lg ml-auto  px-3"><i class="fas fa-plus text-success"></i> Add Page</button>
      </div>
     
    </div>
  </div>
</div>




@endsection
