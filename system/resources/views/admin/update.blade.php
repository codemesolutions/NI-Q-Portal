@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light">
     <div class="bg-white border-bottom px-3 py-3">
        <p class="m-0 text-uppercase" >{!!$title!!} </p>
    </div>
    <div class="container-fluid  p-3 p-md-5">
        <form class="" method="POST" action="{{Route('admin.menu.create')}}">
            <div class="p-3 p-md-5 border bg-white">
                  @foreach($fields as $field)

                    @if($field['type'] == 'text')
                        <div class="form-group">
                            <label>{{$field['label']}}</label>
                            <input type="text" name="{{$field['name']}}"  class="form-control form-control-lg {{$errors->has($field['name']) ? 'is-invalid':''}}" value="{{$field['value']}}"/>
                            @if($errors->has($field['name']))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            <p class="small text-muted">{{$field['helper']}}</p>
                        </div>
                    @elseif($field['type'] == 'checkbox')
                        <div class="form-group mt-4">
                             <div class="custom-control custom-checkbox">
                                <input name="{{$field['name']}}" type="checkbox" class="custom-control-input" id="perm-create-active" checked="{{$field['checked']}}">
                                <label class="custom-control-label" for="perm-create-active">{{$field['label']}}</label>
                            </div>
                        </div>
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
    
@endsection