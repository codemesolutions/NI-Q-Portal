<script src="https://unpkg.com/pdfjs-dist@latest/build/pdf.min.js"></script>

<script src="/js/pdf.js"></script>
<script>
    var scrolled = 0;
    elementCount = 0;
    window.onscroll = function (e) {
        scrolled = window.scrollY // Value of scroll Y in px
    };

    function allowDrop(ev) {
      ev.preventDefault();
    }

    function drag(ev) {
        console.log(ev);
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {

        ev.preventDefault();

        var data = ev.dataTransfer.getData("text");
        var node = document.createElement("input");
        var viewport = document.getElementById('viewport');
        var dragged = document.getElementById(data);
        console.log(data);
        if(dragged.id !== "w9-input"){
            node.type = "text";
            node.style.position = "absolute";
            node.draggable = true;
            node.ondragstart =  drag;
            node.id = "w9-input"

            var y = ev.clientY + window.scrollY;
            var x = ev.clientX + window.scrollX;
            node.style.top = y + "px";
            node.style.left = x + "px";

            viewport.appendChild(node);
            elementCount++;
        }

        else{

            var y = ev.clientY + window.scrollY;
            var x = ev.clientX + window.scrollX;
            dragged.style.top = y + "px";
            dragged.style.left = x + "px";

        }

    }
    </script>

<div class="border  shadow">
    <form style="font-family: Arial, Helvetica, sans-serif;" class="mt-3 questions-form  bg-white  " method="post" action="/donor/form/submit" enctype="multipart/form-data">

        @php $q = $question->question;  @endphp

        <div class="overflow-auto w-100 " style="margin-bottom: -800px; position:relative;z-index:1;">
            <div  style="display:block; width: 1100px; max-height: 80%;"  id="viewport" role="main"></div>

            <input class="w9-name" type="text" name="name"/>
            <input class="w9-business" type="text" name="business"/>
            <input class="w9-indsol" type="checkbox" name="indSol"/>
            <input class="w9-ccorp" type="checkbox" name="ccorp"/>
            <input class="w9-scorp" type="checkbox" name="scorp"/>
            <input class="w9-partnership" type="checkbox" name="partnership"/>
            <input class="w9-trust" type="checkbox" name="trust"/>
            <input class="w9-llc" type="checkbox" name="llc"/>
            <input class="w9-llc-npt" type="text" name="llc_letter"/>
            <input class="w9-other" type="checkbox" name="other"/>
            <input class="w9-other-npt" type="text" name="other_exp"/>
            <input class="w9-excempt" type="text" name="except"/>
            <input class="w9-FACTA" type="text" name="facta"/>
            <input class="w9-address" type="text" name="address"/>
            <input class="w9-citystzip" type="text" name="citystzip"/>
            <input class="w9-requester" type="text" name="requester"/>
            <input class="w9-accounts" type="text" name="accounts"/>
            <input class="w9-social-1" type="text" name="social_1"/>
            <input class="w9-social-2" type="text" name="social_2"/>
            <input class="w9-social-3" type="text" name="social_3"/>
            <input class="w9-social-4" type="text" name="social_4"/>
            <input class="w9-social-5" type="text" name="social_5"/>
            <input class="w9-social-6" type="text" name="social_6"/>
            <input class="w9-social-7" type="text" name="social_7"/>
            <input class="w9-social-8" type="text" name="social_8"/>
            <input class="w9-social-9" type="text" name="social_9"/>
            <input class="w9-ein-1" type="text" name="ein_1"/>
            <input class="w9-ein-2" type="text" name="ein_2"/>
            <input class="w9-ein-3" type="text" name="ein_3"/>
            <input class="w9-ein-4" type="text" name="ein_4"/>
            <input class="w9-ein-5" type="text" name="ein_5"/>
            <input class="w9-ein-6" type="text" name="ein_6"/>
            <input class="w9-ein-7" type="text" name="ein_7"/>
            <input class="w9-ein-8" type="text" name="ein_8"/>
            <input class="w9-ein-9" type="text" name="ein_9"/>
            <input class="w9-signature" type="text" name="signature"/>
            <input class="w9-date" type="text" name="date"/>









            <script>
                window.onload = () => {
                initPDFViewer("{{url('/')}}/file/form/fw9.pdf", "#viewport");
                };
            </script>



            @foreach($question->fields()->orderBy('id')->get() as $k => $field)

            @endforeach
            {!!$q!!}
            @csrf
            <input type="hidden" name="form" value="{{$title}}"/>
            <input type="hidden" name="question" value="{{$question->id}}"/>
            <button class="btn btn-dark m-4" style="position: relative; z-index: 3;" type="submit">Submit</button>
        </div>

    </form>
</div>

