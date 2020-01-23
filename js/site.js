

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



var options = $('select.timezones option');
options.map(option => {
    if(options[option].value == Intl.DateTimeFormat().resolvedOptions().timeZone){
        options[option].selected = true;
    }
});

var options = $('select.hours option');
var now = new Date();
options.map(option => {
    if(options[option].value == getHour(now)){
        options[option].selected = true;
    }
});

var options = $('select.mins option');
var now = new Date();
options.map(option => {
    if(options[option].value == now.getMinutes()){
        options[option].selected = true;
    }
});

var options = $('select.ampm option');
var now = new Date();

options.map(option => {
   
    if(options[option].value == getAMPM(now)){
        options[option].selected = true;
    }
});

function getHour(date) {
    var hours = date.getHours();
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    return hours;
}

function getAMPM(date) {
    var ampm = date.getHours() >= 12 ? 'PM' : 'AM';
    return ampm;
}







