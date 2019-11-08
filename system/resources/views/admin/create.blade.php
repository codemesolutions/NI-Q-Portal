@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3 shadow">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
        <div class="container-fluid  p-3 p-md-5">
            <form class="px-5" method="POST" action="{{Route($form_action_route)}}" enctype="multipart/form-data">
                <div class="p-3 p-md-5 border bg-white">

                    

                    @foreach($fields as $field)

                        @if($field['type'] == 'text')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                <input type="text" name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" value="{{$field['value']}}"/>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'number')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                <input type="number" name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" value="{{$field['value']}}"/>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                         @elseif($field['type'] == 'file')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                <input type="file" name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" value="{{$field['value']}}"/>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'password')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                <input type="password" name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" value="{{$field['value']}}"/>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'hidden')
                            
                            <input type="hidden" name="{{$field['name']}}" value="{{$field['value']}}"/>
                            
                        @elseif($field['type'] == 'select')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                <select name="{{$field['name']}}"  class="form-control form-control-lg {{isset($field['class']) ? $field['class']:''}} {{$errors->has($field['name']) ? 'is-invalid':''}}" >
                                @foreach($field['options'] as $option)
                                        <option value="{{$option['value']}}" {{$option['selected'] === true ? 'selected':null}}>{{$option['name']}}</option>
                                @endforeach
                                </select>
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'textarea')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                            
                                <textarea  name="{{$field['name']}}" class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}">{!!$field['value']!!}</textarea>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'richtext')
                            <div class="form-group mb-4">
                                <label>{{$field['label']}}</label>
                                
                                <textarea  name="{{$field['name']}}" id="editor">{{$field['value']}}</textarea>
                                @if($errors->has($field['name']))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($field['name']) }}</strong>
                                    </span>
                                @endif
                                <p class="small text-muted">{{$field['helper']}}</p>
                            </div>
                        @elseif($field['type'] == 'checkbox')
                            <div class="form-group mt-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="{{$field['name']}}" type="checkbox" class="custom-control-input" id="{{$field['name']}}" {{ $field['checked']  ? 'checked':''}}/>
                                    <label class="custom-control-label" for="{{$field['name']}}">{{$field['label']}}</label>
                                </div>
                            </div>
                        @elseif($field['type'] == 'checkbox-select')
                            
                            @if(count($field['options']) > 0)
                            <label>{{$field['label']}}</label>
                            <div class="bg-light border p-5 mb-4">
                                <input type="search" placeholder="search..." class="form-control mb-2"/>
                                <div style="max-height: 300px; overflow:auto;" class="select-box border bg-white">
                                    @foreach($field['options'] as $option)
                                        <div class="select-box-item  row m-0 border-bottom p-3 {{$option['selected'] ? 'select-box-item-active':''}}">
                                            <div class="custom-control custom-checkbox ml-2">
                                                <input name="{{$field['name']}}[{{$option['value']}}]" type="checkbox" class="custom-control-input" id="{{$field['name'].$option['value']}}" {{$option['selected'] ? 'checked':''}}>
                                                <label class="custom-control-label" for=""></label>
                                            </div> 
                                            <p class="m-0 ml-4">{{$option['name']}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @elseif($field['type'] == 'fields')
                            <div class="fields bg-light border p-3 mb-3">
                                <div class="row m-0 align-items-center">
                                    <button type="button" class="btn btn-primary btn-sm  add-field mr-3">Add Field</button>
                                    <p class="m-0">Click add option to add options to your question.</p>
                                    
                                </div>
                                
                                <div class="{{!is_null(old('fields')) || isset($question) > 0 ? '':'d-none'}} fields-container mt-3">
                                    <div class="d-none field-template mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                        <label class="font-weight-bold m-0 mr-1">#1</label>
                                        <input class="col form-control form-control-sm mr-1" type="text" name="" value="" placeholder="label"/>
                                        <select class="form-control form-control-sm mr-1 col-2 question-field-type">
                                        
                                            @foreach($field['field-types'] as $condition_type)
                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                            @endforeach
                                        </select>
                                        <input class="col-2 form-control form-control-sm mr-1" type="text" name="" value="" placeholder="name"/>
                                        <input class="col-2 form-control form-control-sm" type="text" name="" value="" placeholder="value"/>
                                        <input class="col form-control form-control-sm d-none" type="text" name="" value="" placeholder="options"/>
                                        <input class="col form-control form-control-sm d-none" type="file" name="" value="" placeholder="file"/>
                                        <input class="col form-control form-control-sm col-1 ml-1" type="number" name="order" value="0" placeholder="order"/>
                                        <button type="button" class="btn text-danger btn-sm ml-1 delete-field"><i class="fas fa-times"></i></button>

                                        <div class="col-12 validations p-3 ">
                                            <div class="row m-0 align-items-center">
                                                <button type="button" class="btn btn-primary btn-sm add-validation mr-3">Add Validation</button>
                                            </div>
                                            <div class="d-none validations-container mt-3">
                                                <div class="validations-template d-none  mt-1 row m-0 w-100 bg-light border p-3 align-items-center">
                                                    <label class="font-weight-bold m-0 mr-1">#1</label>
                                                
                                                    <select name="" class="form-control form-control-sm mr-1 col">
                                                        @foreach($field['validation-types'] as $condition_type)
                                                            <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <input class="col form-control form-control-sm" type="text" name="" value="" placeholder="value"/>
                                                    
                                                    <button type="button" class="btn text-danger btn-sm ml-1 delete-validation"><i class="fas fa-times"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    @if(!is_null(old('fields')))
                                        @foreach(old('fields') as $k => $f)
                                            {{var_dump($f['type'])}}
                                             <div class=" mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                                <label class="font-weight-bold m-0 mr-1">#1</label>
                                                @if($errors->has('fields.' . $k) && empty($f['label']) && $f['type'] == 2 || $f['type'] == 3)
                                                <input class="col form-control form-control-sm mr-1 is-invalid" type="text" name="fields[{{$k}}][label]" value="{{$f['label']}}" placeholder="label"/>
                                                @else
                                                 <input class="col form-control form-control-sm mr-1" type="text" name="fields[{{$k}}][label]" value="{{$f['label']}}" placeholder="label"/>
                                                @endif
                                                <select name="fields[{{$k}}][type]" class="form-control form-control-sm mr-1 col-2 question-field-type">
                                                
                                                    @foreach($field['field-types'] as $condition_type)
                                                        @if($condition_type->id == $f['type'])
                                                        <option value="{{$condition_type->id}}" selected>{{$condition_type->name}}</option>
                                                        @else
                                                            <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                
                                                <input class="col-2 form-control form-control-sm mr-1 {{$errors->has('fields.' . $k) && is_null($f['name']) || empty($f['name']) ? 'is-invalid':''}}" type="text" name="fields[{{$k}}][name]" value="{{$f['name']}}" placeholder="name"/>
                                                @if($errors->has('fields.' . $k) && empty($f['value']) && $f['type'] == 2)
                                                    <input class="col-2 form-control form-control-sm is-invalid" type="text" name="fields[{{$k}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @elseif($errors->has('fields.' . $k) && empty($f['value']) && $f['type'] == 3)
                                                    <input class="col-2 form-control form-control-sm is-invalid" type="text" name="fields[{{$k}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @else
                                                    <input class="col-2 form-control form-control-sm " type="text" name="fields[{{$k}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @endif
                                                <input class="col form-control form-control-sm d-none" type="text" name="fields[{{$k}}][options]" value="{{$f['options']}}" placeholder="options"/>
                                                @if(isset($f['file']))
                                                <input class="col form-control form-control-sm d-none" type="file" name="fields[{{$k}}][file]" value="{{$f['file']}}" placeholder="file"/>
                                                @endif
                                                <input class="col form-control form-control-sm col-1 ml-1" type="number" name="fields[{{$k}}][order]" value="0" placeholder="order"/>
                                                <button type="button" class="btn text-danger btn-sm ml-1 delete-field"><i class="fas fa-times"></i></button>
                                                 @if($errors->has('fields.' . $k))
                                                    <span class="invalid-feedback ml-4" role="alert">
                                                        <strong>{{ $errors->first('fields.' . $k) }}</strong>
                                                    </span>
                                                @endif
                                                <div class="col-12 validations p-3 ">
                                                    <div class="row m-0 align-items-center">
                                                        <button type="button" class="btn btn-primary btn-sm add-validation mr-3">Add Validation</button>
                                                    </div>
                                                    <div class="d-none validations-container mt-3">
                                                        <div class="validations-template d-none  mt-1 row m-0 w-100 bg-light border p-3 align-items-center">
                                                            <label class="font-weight-bold m-0 mr-1">#1</label>
                                                        
                                                            <select name="" class="form-control form-control-sm mr-1 col">
                                                                @foreach($field['validation-types'] as $condition_type)
                                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input class="col form-control form-control-sm" type="text" name="" value="" placeholder="value"/>
                                                            
                                                            <button type="button" class="btn text-danger btn-sm ml-1 delete-validation"><i class="fas fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif

                                     @if(is_null(old('fields')) && isset($question))
                                        
                                        @foreach($question->fields()->get() as $k => $f)
                                             
                                             <div class=" mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                                <label class="font-weight-bold m-0 mr-1">#{{$k+1}}</label>
                                                @if($errors->has('fields.' . ($k+1)) && empty($f['label']) && $f['type'] == 2 || $f['type'] == 3)
                                                <input class="col form-control form-control-sm mr-1 is-invalid" type="text" name="fields[{{$k+1}}][label]" value="{{$f['label']}}" placeholder="label"/>
                                                @else
                                                 <input class="col form-control form-control-sm mr-1" type="text" name="fields[{{$k+1}}][label]" value="{{$f['label']}}" placeholder="label"/>
                                                @endif
                                                <select name="fields[{{$k+1}}][type]" class="form-control form-control-sm mr-1 col-2 question-field-type">
                                                
                                                    @foreach($field['field-types'] as $condition_type)
                                                       
                                                        @if($condition_type->id == $f->question_field_type_id->id)
                                                            <option value="{{$condition_type->id}}" selected>{{$condition_type->name}}</option>
                                                        @else
                                                            <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                
                                                <input class="col-2 form-control form-control-sm mr-1 {{$errors->has('fields.' . ($k + 1)) && is_null($f['name']) || empty($f['name']) ? 'is-invalid':''}}" type="text" name="fields[{{$k + 1}}][name]" value="{{$f['name']}}" placeholder="name"/>
                                                @if($errors->has('fields.' . ($k + 1)) && empty($f['value']) && $f['type'] == 2)
                                                    <input class="col-2 form-control form-control-sm is-invalid" type="text" name="fields[{{$k+1}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @elseif($errors->has('fields.' . ($k + 1)) && empty($f['value']) && $f['type'] == 3)
                                                    <input class="col-2 form-control form-control-sm is-invalid" type="text" name="fields[{{$k+1}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @else
                                                    <input class="col-2 form-control form-control-sm " type="text" name="fields[{{$k+1}}][value]" value="{{$f['value']}}" placeholder="value"/>
                                                @endif
                                                <input class="col form-control form-control-sm d-none" type="text" name="fields[{{$k+1}}][options]" value="{{$f['options']}}" placeholder="options"/>
                                                @if(isset($f['file']))
                                                <input class="col form-control form-control-sm d-none" type="file" name="fields[{{$k+1}}][file]" value="{{$f['file']}}" placeholder="file"/>
                                                
                                                @endif
                                                <input class="col form-control form-control-sm col-1 ml-1" type="number" name="fields[{{$k+1}}][order]" value="{{$f['field_order']}}" placeholder="order"/>
                                                <button type="button" class="btn text-danger btn-sm ml-1 delete-field"><i class="fas fa-times"></i></button>
                                                 @if($errors->has('fields.' . ($k + 1)))
                                                    <span class="invalid-feedback ml-4" role="alert">
                                                        <strong>{{ $errors->first('fields.' . ($k + 1)) }}</strong>
                                                    </span>
                                                @endif
                                                <div class="col-12 validations p-3 ">
                                                    <div class="row m-0 align-items-center">
                                                        <button type="button" class="btn btn-primary btn-sm add-validation mr-3">Add Validation</button>
                                                    </div>
                                                    
                                                    <div class="{{$f->validations()->count() > 0 ? '':'d-none'}} validations-container mt-3">
                                                        <div class="validations-template d-none  mt-1 row m-0 w-100 bg-light border p-3 align-items-center">
                                                            <label class="font-weight-bold m-0 mr-1">#1</label>
                                                        
                                                            <select name="" class="form-control form-control-sm mr-1 col">
                                                                @foreach($field['validation-types'] as $condition_type)
                                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <input class="col form-control form-control-sm" type="text" name="" value="" placeholder="value"/>
                                                            
                                                            <button type="button" class="btn text-danger btn-sm ml-1 delete-validation"><i class="fas fa-times"></i></button>
                                                        </div>

                                                        @foreach($f->validations()->get() as $vk => $v)
                                                            <div class="validations-template  mt-1 row m-0 w-100 bg-light border p-3 align-items-center">
                                                                <label class="font-weight-bold m-0 mr-1">#{{$vk + 1}}</label>
                                                                
                                                                <select name="fields[{{$k + 1}}][validation][{{$vk + 1}}][type]" class="form-control form-control-sm mr-1 col">
                                                                    @foreach($field['validation-types'] as $condition_type)
                                                                        @if($v->id == $condition_type->id)
                                                                            <option selected value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                                        @else
                                                                             <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                <input class="col form-control form-control-sm" type="text" name="fields[{{$k + 1}}][validation][{{$vk + 1}}][value]" value="{{$v->pivot->value}}" placeholder="value"/>
                                                                
                                                                <button type="button" class="btn text-danger btn-sm ml-1 delete-validation"><i class="fas fa-times"></i></button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    @endif

                                </div>
                            </div>
                            @if(is_null(old('fields')) && !isset($question))
                            <div class="conditions bg-light border p-3 mb-3 d-none">
                                <div class="row m-0 align-items-center">
                                    <button type="button" class="btn btn-primary btn-sm  add-condition mr-3">Add Condition</button>
                                    <p class="m-0">Click add option to add options to your question.</p>
                                    
                                </div>
                                <div class="d-none conditions-container mt-3">
                                    <div class="d-none conditions-template mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                        <label class="font-weight-bold m-0 mr-1">#1</label>
                                        <select name="" class="form-control form-control-sm mr-1 col question-condition-fields">
                                        </select>
                                        <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                            @foreach($field['condition-types'] as $condition_type)
                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                            @endforeach
                                        </select>
                                        <input class="col form-control form-control-sm mr-1" type="text" name="" value="" placeholder="value"/>
                                    
                                        <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                            @foreach($field['condition-actions'] as $condition_type)
                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="row m-0 align-items-center ml-3"><input class=" mr-1" type="checkbox" name=""  placeholder="value"/> From Date Field</span>
                                        <button type="button" class="btn text-danger btn-sm ml-1 delete-condition"><i class="fas fa-times"></i></button>

                                    
                                    </div>
                                </div>
                            </div>
                            @elseif(!is_null(old('fields')) && !isset($question))
                                <div class="conditions bg-light border p-3 mb-3">
                                    <div class="row m-0 align-items-center">
                                        <button type="button" class="btn btn-primary btn-sm  add-condition mr-3">Add Condition</button>
                                        <p class="m-0">Click add option to add options to your question.</p>
                                        
                                    </div>
                                    <div class=" conditions-container mt-3">
                                        <div class="d-none conditions-template mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                            <label class="font-weight-bold m-0 mr-1">#1</label>
                                            <select name="" class="form-control form-control-sm mr-1 col question-condition-fields">
                                                 @foreach(old('fields') as $fk => $fv)
                                                        
                                                    <option value="{{$fk + 1}}">field #{{$fk + 1}}</option>
                                                     
                                                @endforeach
                                            </select>
                                            <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                @foreach($field['condition-types'] as $condition_type)
                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                @endforeach
                                            </select>
                                            <input class="col form-control form-control-sm mr-1" type="text" name="" value="" placeholder="value"/>
                                             <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                @foreach($field['condition-actions'] as $condition_type)
                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="row m-0 align-items-center ml-3"><input class=" mr-1" type="checkbox" name=""  placeholder="value"/> From Date Field</span>
                                            <button type="button" class="btn text-danger btn-sm ml-1 delete-condition"><i class="fas fa-times"></i></button>
                                        </div>
                                       
                                        @foreach(old('conditions') as $ck => $c)
                                            
                                           
                                                 <div class="mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                                    <label class="font-weight-bold m-0 mr-1">#{{$ck + 1}}</label>
                                                    <select name="conditions[{{$ck + 1}}][field]" class="form-control form-control-sm mr-1 col question-condition-fields">
                                                        @foreach(old('conditions') as $ck => $c)
                                                             <option value="{{$ck}}">field #{{$ck}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="conditions[{{$ck + 1}}][type]" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                        @foreach($field['condition-types'] as $condition_type)
                                                            @if($c['type'] == $condition_type->id)
                                                                <option selected value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @else
                                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input class="col form-control form-control-sm mr-1" type="text" name="conditions[{{$ck + 1}}][value]" value="{{$c['value']}}" placeholder="value"/>
                                                     <select name="conditions[{{$ck + 1}}][action]" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                        @foreach($field['condition-actions'] as $condition_type)
                                                            <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="row m-0 align-items-center ml-3"><input class=" mr-1" type="checkbox" name=""  placeholder="value"/> From Date Field</span>
                                                    <button type="button" class="btn text-danger btn-sm ml-1 delete-condition"><i class="fas fa-times"></i></button>
                                                </div>
                                   

                                        @endforeach
                                    </div>
                                </div>
                           
                            @elseif(is_null(old('fields')) && isset($question))
                                <div class="conditions bg-light border p-3 mb-3">
                                    <div class="row m-0 align-items-center">
                                        <button type="button" class="btn btn-primary btn-sm  add-condition mr-3">Add Condition</button>
                                        <p class="m-0">Click add option to add options to your question.</p>
                                        
                                    </div>
                                    <div class=" conditions-container mt-3">
                                        <div class="d-none conditions-template mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                            <label class="font-weight-bold m-0 mr-1">#1</label>
                                            <select name="" class="form-control form-control-sm mr-1 col question-condition-fields">
                                                 @foreach($question->fields()->get() as $fk => $fv)
                                                        
                                                    <option value="{{$fk + 1}}">field #{{$fk + 1}}</option>
                                                     
                                                @endforeach
                                            </select>
                                            <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                @foreach($field['condition-types'] as $condition_type)
                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                @endforeach
                                            </select>
                                            <input class="col form-control form-control-sm mr-1" type="text" name="" value="" placeholder="value"/>
                                             <select name="" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                @foreach($field['condition-actions'] as $condition_type)
                                                    <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="row m-0 align-items-center ml-3"><input class=" mr-1" type="checkbox" name=""  placeholder="value"/> From Date Field</span>
                                            <button type="button" class="btn text-danger btn-sm ml-1 delete-condition"><i class="fas fa-times"></i></button>
                                        </div>

                                        @foreach($question->fields()->get() as $f)

                                            @if($f->conditions()->count() > 0)
                                                @foreach($f->conditions()->get() as $ck => $condition)
                                                 <div class="mt-3 row m-0 w-100 bg-white border p-3 pt-4 align-items-center">
                                                    <label class="font-weight-bold m-0 mr-1">#{{$ck+1}}</label>
                                                    <select name="conditions[{{$ck + 1}}][field]" class="form-control form-control-sm mr-1 col question-condition-fields">
                                                        @foreach($question->fields()->get() as $fk => $fv)
                                                            @if($condition->field_id == $fv->id)
                                                                <option value="{{$fk + 1}}" selected>field #{{$fk + 1}}</option>
                                                            @else
                                                                <option value="{{$fk + 1}}">field #{{$fk + 1}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <select name="conditions[{{$ck + 1}}][type]" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                        @foreach($field['condition-types'] as $condition_type)
                                                            @if($condition->question_condition_type_id == $condition_type->id)
                                                                <option selected value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @else
                                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input class="col form-control form-control-sm mr-1" type="text" name="conditions[{{$ck + 1}}][value]" value="{{$condition->condition}}" placeholder="value"/>
                                                     <select name="conditions[{{$ck + 1}}][action]" class="form-control form-control-sm mr-1 col question-conditions-type">
                                                        @foreach($field['condition-actions'] as $condition_type)
                                                              @if($condition->question_condition_action_id == $condition_type->id)
                                                                <option selected value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @else
                                                                <option value="{{$condition_type->id}}">{{$condition_type->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    
                                                    <span class="row m-0 align-items-center ml-3"><input {{$condition->show_date_field == 1 ? 'checked':''}} class=" mr-1" type="checkbox" name="conditions[{{$ck + 1}}][date]" /> From Date Field</span>
                                                    
                                                    <button type="button" class="btn text-danger btn-sm ml-1 delete-condition"><i class="fas fa-times"></i></button>
                                                </div>
                                                @endforeach

                                            @endif

                                        @endforeach
                                    </div>
                                </div>
                            @endif
                    
                        
                    
                        
                        @endif
                    @endforeach
                
                </div>
                @csrf
                <div class="row m-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
