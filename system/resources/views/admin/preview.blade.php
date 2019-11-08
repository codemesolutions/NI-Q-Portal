@extends('site.layouts.app')

@section('content')

<div class="py-5">

    <div  class="container p-5">
        
        <div style="background:#fff;" class="p-5 border shadow-sm">
            <div class="m-0 mb-4 row ">
                <p class='m-0 text-dark'>{{$form->name}} - </p>
                <p class='m-0 text-teal'>&nbsp;{{$form_page->name}}</p>
            </div>
           
            <form method="POST" action="{{url('/')}}/form/page/{{$form->name}}/{{$form_page->name}}">
            @foreach($form_page->fields()->orderBy('position', 'asc')->get() as $field)
                 @if($field->type === 'input.text' || $field->type === 'input.password' || $field->type === 'input.search' || $field->type === 'input.checkbox' || $field->type === 'input.radio')
                    <div class="form-group">
                        @if(!is_null($field->label))
                            <label>{{$field->label}}</label>
                        @endif
                        <input style="{{$field->style}}" class="{{$field->class}} {{$errors->has(str_replace(' ', '_', $field->name)) ? 'is-invalid':''}}" type="{{(explode('.', $field->type)[1])}}" name="{{$field->name}}" value="{{$field->value}}" placeholder="{{$field->placeholder}}"/>
                         
                        @if($errors->has(str_replace(' ', '_', $field->name)))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first(str_replace(' ', '_', $field->name)) }}</strong>
                            </span>
                        @endif
                        <p class="small text-muted">{{$field->helper_text}}</p>

                    </div>
                 @elseif($field->type === 'select')
                    <div class="form-group">
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
                    </div>
                @elseif($field->type === 'textarea')
                    <div class="form-group">
                    <label>{{$field->label}}</label>
                    <textarea style="{{$field->style}}" class="{{$field->class}}" type="{{(explode('.', $field->type)[1])}}" name="{{$field->name}}" placeholder="{{$field->placeholder}}">{{$field->value}}</textarea>
                    <p class="small text-muted">{{$field->helper_text}}</p>
                    </div>
                @elseif($field->type === 'h1')
                    <div class="editor-content">
                        <h1 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h1>
                    </div>
                @elseif($field->type === 'h2')
                    <div class="editor-content">
                        <h2 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h2>
                    </div>
                @elseif($field->type === 'h3')
                    <div class="editor-content">
                        <h3 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h3>
                    </div>
                @elseif($field->type === 'h4')
                    <div class="editor-content">
                        <h4 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h4>
                    </div>
                @elseif($field->type === 'h5')
                    <div class="editor-content">
                        <h5 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h5>
                    </div>
                @elseif($field->type === 'h6')
                    <div class="editor-content">
                        <h6 id={{$field->input_id}} style="{{$field->style}}" class={{$field->class}}>{{$field->value}}</h6>
                    </div>
                @elseif($field->type === 'p')
                    <div class="editor-content">
                        <p id="{{$field->input_id}}" style="{{$field->style}}" class="{{$field->class}}">{{$field->value}}</p>
                    </div>

               @elseif($field->type === 'button')
                    <div class="row m-0">
                        <button type="button" id={{$field->input_id}} style="{{$field->style}}" class="{{$field->class}}" value="submit">{{$field->value}}</button>
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
            @endforeach;
            @csrf
            </form>
        </div>
    </div>
</div>

@endsection
