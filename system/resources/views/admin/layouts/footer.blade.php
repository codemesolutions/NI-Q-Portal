
  
    <!-- Scripts -->

     <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <script>

        var allEditors = document.querySelectorAll('#editor');
        for (var i = 0; i < allEditors.length; ++i) {
             ClassicEditor
            .create( allEditors[i] , {
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' }
                       
                    ]
                }
            })
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        }
      
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script src="{{ asset('js/app.js') }}"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
   
   
    <script src="{{ asset('js/admin.js') }}"></script>

   
    
    @if(!is_null(old('modal')))
        <script>
           
            $('#{{old("modal")}}').modal('show')

            
            
        </script>
    @endif
    
    @if(isset($form_pages) && $form_pages->count() == 0)
    <script type="text/javascript">
            $('#createpages').modal('show');
    
    </script>
    @endif

    
    <script>
        $("#backgroundpicker").spectrum({
            color: "#fff"
        });

        $("#fontpicker").spectrum({
            color: "#fff"
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>

</script>
   

</body>
</html>