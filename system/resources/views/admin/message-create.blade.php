@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-teal border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid p-0" style="height:calc(100% - 52.2px);">
        <form class="row m-0 h-100" method="POST" action="{{Route($form_action_route)}}">
            <div class="p-3 p-md-5 border-right bg-white col-7 " style="height:calc(100% - 53.2px);">

                

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
                            <select name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" >
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
                  
                    @endif
                @endforeach
              
            </div>
            @csrf
            <div class="col-12 col-md-5 bg-light p-0" style="height:calc(100% - 53.2px);">
                  @if($fields['users']['type'] == 'checkbox-select')
                        
                        @if(count($field['options']) > 0)
                         
                         <div class="bg-light  p-5 h-100">
                            <label>{{$field['label']}}</label>
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
                    @endif
            </div>
            <div class="row m-0 col-12 p-0">
                <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Send Message</button>
            </div>
        </form>
    </div>
</div>
    
@endsection
