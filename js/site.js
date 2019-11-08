

$('form.questions-form input').on("change", function(){

    if($(this).hasClass('condition') == false){
        var val = $('.conditions input').data('condition');
    
        if(val !== null && val !== undefined && val === this.value){
            $('.conditions').removeClass('d-none');
            return false;
        }
    
        else{
            $('.conditions').addClass('d-none');
            return false;
        }
    }

    return false;
   
});


