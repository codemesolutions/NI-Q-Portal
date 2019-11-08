@extends('admin.layouts.app')

@section('content')
 
<div class="bg-light h-100">
     <div class="bg-dark px-3 py-3 row m-0">
        <p class="m-0 text-uppercase text-white mr-auto" >{!!$title!!} </p>
       
    </div>
    <div style="height: calc(100% - 51.2px);" class="overflow-auto">
        <div class="container-fluid  p-3 p-md-5">
            <form class="px-5" method="POST" action="/admin/forms/submissions/submission/map" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="submission" value="{{$submission->id}}"/>
                <div class="p-3 p-md-5 border  bg-white">
                     <div class="row m-0 align-items-center mb-4">
                        <h5 class="m-0 mr-auto">Form Submission</h5>
                        <a href="#" class="btn btn-primary btn-sm  mr-1 "><i class="fas fa-print"></i> Print</a>
                       
                    </div>
                    <div class="row bg-light border border-bottom-0 p-3 m-0 align-items-center mb-0">
                        <p class="m-0 mr-auto font-weight-bold">User Information</p>
                     
                    </div>
                    <div class=" m-0 mb-4 ">
                        <table class="table table-bordered  bg-white">
                            <tbody>
                                <tr>
                                    <td class="w-25">Name:</td>
                                    <td class="pl-3">{{$submission->user_id->first_name}}, {{$submission->user_id->last_name}}</td>
                                </tr>

                                 <tr>
                                    <td class="">Email:</td>
                                    <td class="pl-3">{{$submission->user_id->email}}</td>
                                </tr>

                                 <tr>
                                    <td class="">Disqualified:</td>
                                    <td class="pl-3">{{$submission->blocked == 0 ? "No":"Yes"}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                   
                    @if(isset($datasets['list']))
                        
                        @php $count = 1; @endphp
                        @foreach($datasets['list']['rows'] as $question)
                            <div class=" my-5">
                                <p class="mb-0 bg-light border border-bottom-0 p-3 font-weight-bold">#{{$count++}}. &nbsp; {{ucfirst(strip_tags($question->question))}}</p>

                                <table class="table table-bordered bg-white">
                                    <tbody>
                                        @php 
                                            $fcount = 1; 
                                            $fields = []; 
                                        @endphp
                                        @foreach($question->fields()->get() as $field)
                                            @php 
                                                $answer = \App\QuestionAnswer::where('question_id', $question->id)->where('field_id', $field->id)->where('user_id', $submission->user_id->id)->first();
            
                                            @endphp
                                            @if(!is_null($answer) && !isset($fields[$field->name]))
                                                <tr>
                                                    @if($field['question_field_type_id']->id == 6)
                                                        @php 
                                                            $ext = pathinfo($answer->answer, PATHINFO_EXTENSION);
                                                        @endphp
                                                        @if($ext == "doc" || $ext === "docx")
                                                            <td class="pl-3"><iframe style="height: 500px;" class="w-100 border mb-3" src="https://docs.google.com/gview?url={{url('/')}}/file/{{$answer->answer}}&embedded=true" frameborder="0">
</iframe></td>
                                                        @else
                                                            <td class="pl-3"><a href="{{url('/')}}/file/{{$answer->answer}}">{{ucfirst($answer->answer)}}</a></td>
                                                        @endif
                                                        
                                                    @else
                                                         <td class="pl-3">{{ucfirst($answer->answer)}}</td>
                                                    @endif
                                                </tr>
                                           
                                            @endif  

                                            @php 
                                                if(!isset($fields[$field->name])){
                                                        $fields[$field->name] = $answer;
                                                }
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        @endforeach
                    @endif

                    <div class="bg-light border p-5 mb-5">
                        <input type="search" placeholder="search..." class="form-control mb-2"/>
                        <div style="max-height: 300px; overflow:auto;" class="select-box border bg-white">
                            @foreach($forms as $form)
                                <div class="select-box-item  row m-0 border-bottom p-3">
                                    <div class="custom-control custom-checkbox ml-2">
                                        <input name="forms[{{$form->id}}]" type="checkbox" class="custom-control-input" id="{{$form->id}}">
                                        <label class="custom-control-label" for=""></label>
                                    </div> 
                                    <p class="m-0 ml-4">{{$form->name}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                   
                    <div class="row m-0 align-items-center mb-4">
                        
                        <button type="submit" class="btn btn-success mr-1 ml-auto"><i class="fas fa-thumbs-up"></i> Approve</button>
                        <a href="#" class="btn btn-danger  mr-1"><i class="fas fa-lock"></i> Deny</a>
                    </div>
                </div>
              
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog rounded-0" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-header align-items-center bg-light rounded-0 p-0 p-3">
        <p class="modal-title m-0" id="exampleModalLabel"> Approve Submission?</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-3">
        <div class="row m-0 align-items-center">
            <div class="col-4 ">
                <h1 class="display-3 m-0 text-danger text-right"><i class="fas fa-exclamation-triangle"></i></h1>
            </div>
            <div class="col">
                <h5>Are you sure?</h5>
                <p>Are you sure you want to approve?.  Once approved a donor will be created from the information provided.</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-thumbs-down"></i> Cancel</button>
        <a type="button" href="/admin/forms/submissions/submission/map?submission={{$submission->id}}" class="btn btn-success"><i class="fas fa-thumbs-up"></i> Approve</a>
      </div>
    </div>
  </div>
</div>
    
@endsection
