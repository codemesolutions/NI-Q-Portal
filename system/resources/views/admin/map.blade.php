@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3">
        <p class="m-0 text-uppercase text-white" >{!!$title!!} </p>
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
        @if(Session::has('success'))
           
            <div class="alert alert-success alert-dismissible fade show mb-4 rounded-0 " role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->count() > 0)
            {{dd($errors->all())}}
        @endif
        <div class="container-fluid  p-3 p-md-5">
            <form class="px-5" method="POST" action="{{Route($form_action_route)}}" enctype="multipart/form-data">
                <div class="p-3 p-md-5 border bg-white">
                    <h5 class="mb-4">Form Questions Map</h5>
                    <div class="alert alert-danger alert-dismissible fade show mb-4 small rounded-0 row m-0 py-3" role="alert">
                        <strong class="mr-3">DANGER!</strong> Only change if you know where the data is saved in the database.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   
                    @if(isset($datasets['questions']))
                        @php $count = 1; @endphp
                        @foreach($datasets['questions']['rows'] as $question)
                            <div class="border bg-light p-4 mb-4">
                               
                                <h5 class="mb-4">#{{$count++}}. - {{strip_tags($question->question)}}</h5>
                              
                                    <table style="table-layout:fixed;" class="w-100 ">
                                        <tbody>
                                            @php $fcount = 1; @endphp
                                            @foreach($question->fields()->get() as $field)
                                            <tr class="bg-white border mb-3">
                                                <td class="align-middle  px-4">
                                                    #{{$fcount++}}. &nbsp; {{$field->name}}:[{{$field->question_field_type_id->name}}]
                                                </td>
                                                <td class="p-3">
                                                    @php $qm = App\FormQuestionMap::where('question_id', $question->id)->where('field_id', $field->id)->first(); @endphp
                                                    
                                                    <select class="form-control" name="questions[{{$question->id}}][{{$field->id}}][col]">
                                                        <option value="">Select a table column</option>
                                                        @foreach($datasets['tables']['rows'] as $table => $columns)
                                                            @foreach($columns as $column)
                                                                @if(!is_null($qm) && $qm->table === $table && $qm->column === $column)
                                                                    <option selected>{{$table}} : {{$column}}</option>
                                                                @else
                                                                    <option>{{$table}} : {{$column}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </td>
                                                 <td class="p-3">
                                                    @php $qm = App\FormQuestionMap::where('question_id', $question->id)->where('field_id', $field->id)->first(); @endphp

                                                    @if(!is_null($qm) && !is_null($qm->value))
                                                    <input class="form-control" name="questions[{{$question->id}}][{{$field->id}}][val]" value="{{$qm->value}}"/>
                                                    @else
                                                     <input class="form-control" name="questions[{{$question->id}}][{{$field->id}}][val]" value=""/>
                                                    @endif
                                        
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                            </div>
                           
                        @endforeach
                    @endif
                   
                
                </div>
                <input type="hidden" name="form" value="{{$form->id}}"/>
                @csrf
                <div class="row m-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block  py-3">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
