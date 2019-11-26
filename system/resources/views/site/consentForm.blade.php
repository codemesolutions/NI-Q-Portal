
<div class="border p-5 shadow">
    <form style="font-family: Arial, Helvetica, sans-serif;" class="mt-3 questions-form  bg-white p-5 " method="post" action="/donor/form/submit" enctype="multipart/form-data">

        @php $q = $question->question;  @endphp
        @foreach($question->fields()->orderBy('id')->get() as $k => $field)
            @php


                $invalid = $errors->has($field->name) ? 'is-invalid':"";

                if($field->name == "sign"){
                    $q = preg_replace('/\['.$field->name.'\]/im', '<input class="'.$invalid.' font-sign w-auto form-control form-control-sm d-inline-block" style="border:none; border-bottom: #333 1px solid;" placeholder="'.$field->label.'" type="text" name="'.$field->name.'"/>', $q);
                }

                elseif($field->name == "date"){
                    $q = preg_replace('/\['.$field->name.'\]/im', '<input class="'.$invalid.' w-auto form-control form-control-sm d-inline-block" style="border:none; border-bottom: #333 1px solid; position:relative; top:1px;" placeholder="'.$field->label.'" type="date" name="'.$field->name.'"/>', $q);
                }

                else{
                    $q = preg_replace('/\['.$field->name.'\]/im', '<input class="'.$invalid.' w-auto form-control form-control-sm d-inline-block " style="border:none; border-bottom: #333 1px solid;" placeholder="'.$field->label.'" type="text" name="'.$field->name.'"/>', $q);
                }

            @endphp
        @endforeach
        {!!$q!!}
        @csrf
        <input type="hidden" name="form" value="{{$title}}"/>
        <input type="hidden" name="question" value="{{$question->id}}"/>
        <button class="btn btn-dark mt-4" type="submit">Submit</button>
    </form>
</div>

