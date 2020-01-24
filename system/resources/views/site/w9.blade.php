<script src="https://unpkg.com/pdfjs-dist@latest/build/pdf.min.js"></script>

<script src="/js/pdf.js"></script>


<div class="border  shadow">
    <form style="font-family: Arial, Helvetica, sans-serif;" class="mt-3 questions-form  bg-white  " method="post" action="/donor/form/submit" enctype="multipart/form-data">

        @php $q = $question->question;  @endphp

        @foreach($question->fields()->orderBy('id')->get() as $k => $field)
            @if($field->question_field_type_id->id == 7)
            <div class="w-100 h-100">
                <div style="height:100%; width: 100%;">
                    <div style="padding: 0; background: #333;">
                        <div style="display:block; "  id="viewport" role="main"></div>
                        <script>
                            window.onload = () => {
                              initPDFViewer("{{url('/')}}/file/{{$field->download}}", "#viewport");
                            };
                          </script>
                    </div>
                </div>
            </div>

            @endif
        @endforeach
        {!!$q!!}
        @csrf
        <input type="hidden" name="form" value="{{$title}}"/>
        <input type="hidden" name="question" value="{{$question->id}}"/>
        <button class="btn btn-dark mt-4" type="submit">Submit</button>
    </form>
</div>

