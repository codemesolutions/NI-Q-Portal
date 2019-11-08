@extends('site.layouts.app')


@section('content')
    @if($type == 'donor')
        @include('site.blocks.donor-heading')
        @include('site.blocks.donor-nav')
    @else
         <div class=" jumbotron jumbotron-fluid bg-image py-5">
            <div class="container py-5 text-center">
                <div class="py-5"></div>
            </div>
        </div>
    @endif
<div class="bg-white">
    <div class="container py-5">
        <div class=" p-md-5">
            <h3 class="m-0 text-center font-weight-bold pb-5 mb-3">{!!$title!!}</h3>
            <div class="col-md-8 mx-auto mb-3 ">
                    <h4 class="font-weight-bold">Question {{$current_question_number}} of {{$question_total}}</h4>
                    <p>Please answer each question to the best of your knowledge.  We take great pride in providing a simple but effective process to ensure we work with moms who understand our mission of providing high quality breast milk that is throughly tested and trusted.</p>
                </div>
            <div style="background:#edf1f2;" class="col-md-8 mx-auto answer p-5">
                
                @if($errors->count() > 0)
                    <div class="alert alert-danger rounded-0 alert-dismissible fade show" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row m-0 align-items-center">
                  {!!$question->question!!}
                </div>
                <form class="mt-3 questions-form" method="post" action="/form/submit" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form" value="{{$title}}"/>
                    <input type="hidden" name="question" value="{{$question->id}}"/>
                    @php $conditions = []; @endphp
                   @foreach($question->fields()->orderBy('field_order')->get() as $k => $field)
                        
                        @if($field->question_field_type_id->id == 1)
                            <div class="form-group">
                                <label>{{$field->label}}</label>
                                <input class="form-control {{$errors->has($field->name) ? 'is-invalid':''}}" type="text" name="{{$field->name}}" value=""/>
                                  @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback  m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                            </div>
                        @elseif($field->question_field_type_id->id == 9)
                            <div class="form-group">
                                <label>{{$field->label}}</label>
                                <input class="form-control {{$errors->has($field->name) ? 'is-invalid':''}}" type="password" name="{{$field->name}}" value=""/>
                                  @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback  m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                            </div>
                        @elseif($field->question_field_type_id->id == 4)
                            <div class="form-group">
                                <label>{{$field->label}}</label>
                                <textarea class="form-control {{$errors->has($field->name) ? 'is-invalid':''}}" name="{{$field->name}}"></textarea>
                                  @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback  m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                            </div>
                        @elseif($field->question_field_type_id->id == 5)
                            <div class="form-group">
                                @php      
                                    $_options = explode(",", rtrim($field->options, ','));
                                    $options = [];
                                    foreach($_options as $k => $v){
                                       
                                        if(preg_match("/\:/", $v)){
                                            $v = str_replace(' ', '', $v);
                                            $p = explode(":", $v);
                                            $options[$p[0]] = $p[1]; 
                                        }

                                        else{
                                            $v = str_replace(' ', '', $v);
                                            $options[$v] = $v;
                                        }

                                       
                                    }

                                    
                                @endphp
                                <label>{{$field->label}}</label>
                                <select class="form-control {{$errors->has($field->name) ? 'is-invalid':''}}" name="{{$field->name}}">
                                  @foreach ($options as $val => $option)
                                      <option value="{{$val}}">{{$option}}</option>
                                  @endforeach
                                </select>
                                  @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                            </div>
                        @elseif($field->question_field_type_id->id == 7)
                            <iframe style="height: 500px;" class="w-100 border mb-3" src="https://docs.google.com/gview?url={{url('/')}}/file/{{$field->download}}&embedded=true" frameborder="0">
</iframe>
                            <div class="w-100 border bg-light p-3 row m-0 align-items-center">
                                <p class="m-0 font-weight-bold mr-2">Download:<p> <a class="" href="/file/{{$field->download}}">{{$field->label}}</a>
                            </div>
                        @elseif($field->question_field_type_id->id == 6)

                            <div class="form-group">
                                <label>{{$field->label}}</label>
                                <input class="form-control {{$errors->has($field->name) ? 'is-invalid':''}}" type="file" name="{{$field->name}}" value=""/>
                                  @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback  m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                            </div>

                        @elseif($field->question_field_type_id->id == 2)
                            <div class="form-group row m-0 mb-2 align-items-center">
                                <div class="custom-control custom-radio">
                                    @if(old($field->name) === $field->value)
                                    <input checked type="radio" id="{{$field->name . $k}}'" name="{{$field->name}}" value="{{$field->value}}" class="custom-control-input {{$errors->has($field->name) ? 'is-invalid':''}} ">
                                    <label class="custom-control-label " for="{{$field->name . $k}}'">{{$field->label}}</label>
                                    @else
                                    <input type="radio" id="{{$field->name . $k}}'" name="{{$field->name}}" value="{{$field->value}}" class="custom-control-input {{$errors->has($field->name) ? 'is-invalid':''}} ">
                                    <label class="custom-control-label " for="{{$field->name . $k}}'">{{$field->label}}</label>
                                    @endif
                                </div>
                              
                                 @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback col m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                                
                            </div>
                         @elseif($field->question_field_type_id->id == 3)
                            <div class="form-group row m-0 mb-2 align-items-center">
                                <div class="custom-control custom-radio">
                                    <input type="checkbox" id="{{$field->name . $k}}'" name="{{$field->name}}" value="{{$field->value}}" class="custom-control-input {{$errors->has($field->name) ? 'is-invalid':''}} ">
                                    <label class="custom-control-label " for="{{$field->name . $k}}'">{{$field->label}}</label>
                                </div>
                              
                                 @if($errors->has($field->name))
                                    
                                    <span class="invalid-feedback col m-0" role="alert">
                                        <strong>{{ $errors->first($field->name) }}</strong>
                                    </span>
                                    
                                @endif
                                
                            </div>
                        @endif

                        @if($field->conditions()->count() > 0)
                           @php $conditions[] = $field; @endphp
                        @endif

                   @endforeach

                   @foreach($conditions as $con)
                        @foreach($con->conditions()->get() as $c)
                            @if($c->show_date_field && $c->question_condition_type_id == 1)
                                @if($errors->has('condition_date'))
                                    <div class="form-group w-50 conditions">
                                        <label>If answer equals {{$con->label}} please enter the date</label>
                                        <input data-condition="{{$c->condition}}" class="form-control condition is-invalid" type="date" name="condition_date"/>
                                         @if($errors->has('condition_date'))
                                    
                                            <span class="invalid-feedback col m-0" role="alert">
                                                <strong>{{ $errors->first('condition_date') }}</strong>
                                            </span>
                                            
                                        @endif
                                    </div>
                                @else
                                <div class="form-group w-50 conditions d-none">
                                        <label>If answer equals {{$con->label}} please enter the date</label>
                                        <input data-condition="{{$c->condition}}" class="form-control condition" type="date" name="condition_date"/>
                                    </div>
                                @endif
                            @elseif($c->show_date_field && $c->question_condition_type_id == 2)
                                <div class="form-group w-50 conditions d-none">
                                    <label>If answer greater than {{$con->label}}</label>
                                    <input class="form-control condition" type="date" name="condition_date"/>
                                </div>
                            @endif
                        @endforeach
                   @endforeach

                    @if($question->has_why_field)
                        <div class="form-group mt-4">
                            <label>Please specify the reason why</label>
                            <textarea class="form-control " name="why" placeholder="why?"></textarea>
                        </div>
                    @endif
                    @if($question->additional_info_field)
                        <div class="form-group mt-4">
                            <label>Additional Information</label>
                            <textarea class="form-control " name="why" placeholder="any additional info?"></textarea>
                        </div>
                    @endif
                    <button class="btn btn-dark btn-sm mt-3" type="submit">Submit</button>
                </form>
                <p class="small mt-4">Please answer each question as accuratly as you can.  Please understand our application process is to ensure we provide the best service to you.</p>
            </div>

        </div>
    </div>
</div>
@endsection
