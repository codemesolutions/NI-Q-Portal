
searchable('input.table-search', 'table.searchable');


function searchable(input, table){

   var input =  document.querySelector(input);
   var table =  document.querySelector(table);

    if(input !== null){
        input.addEventListener('change', function(){
            var filter = this.value.toUpperCase();
            var rows = table.getElementsByTagName('tr');

            for(r = 1; r < rows.length; r++){
                var row = rows[r];

                var columns = row.getElementsByTagName('td');
                var matched = false;

                for(c = 1; c < columns.length; c++){
                    var column = columns[c];

                    if(column){
                        var content = column.textContent || column.innerText;
                        
                        
                        if (content.toUpperCase().indexOf(filter, 0) > -1) {
                            matched = true;
                        } 
                    }
                }

                if(!matched){
                row.style.display="none";
                }
                else{
                row.style.display="";
                }

            }
        });
    }
}

function sortable( n, table){
   
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.querySelector(table);
    switching = true;
    // Set the sorting direction to ascending:
    dir = "asc"; 
    
    for(th = 0; th < document.querySelector('table thead tr').children.length; th++){
        if(document.querySelector('table thead tr').children[th].getElementsByTagName('i')[0] !== undefined){
            document.querySelector('table thead tr').children[th].getElementsByTagName('i')[0].classList.remove('fa-sort-up');
            document.querySelector('table thead tr').children[th].getElementsByTagName('i')[0].classList.remove('fa-sort-down');
            document.querySelector('table thead tr').children[th].getElementsByTagName('i')[0].classList.add('fa-sort');
        }
    }

  

    var iel  = document.querySelector('table thead tr').children[n].getElementsByTagName('i')[0];
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
    // Start by saying: no switching is done:
        switching = false;
        rows = table.rows;
       
        /* Loop through all table rows (except the
        first, which contains table headers): */
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
                shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /* Check if the two rows should switch place,
            based on the direction, asc or desc: */
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    
                    iel.classList.remove('fa-sort');
                    iel.classList.remove('fa-sort-down');
                    iel.classList.add('fa-sort-up');
                  
                    console.log(iel);
                    break;
                }
            } 

            else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    iel.classList.remove('fa-sort-up');
                    iel.classList.add('fa-sort-down');
                    break;
                }
            }
        }

        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
           
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            // Each time a switch is done, increase this count by 1:
            switchcount ++; 
        } 
        
        else {
            /* If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again. */
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

onCheckSelectAll();

function onCheckSelectAll(){
    $(".select-all").on("click", function(){
       
        if($(this).find('input').prop('checked')){
            $(".searchable tr td input").prop('checked', true);
            $('.delete').removeClass('d-none');
        }

        else{
            $(".searchable tr td input").prop('checked', false);
            $('.delete').addClass('d-none');
        }
    })
}

onRowCheckBoxSelect();

function onRowCheckBoxSelect(){
    $(".searchable tbody tr td input").on("click", function(){
        
        if(this.checked){
            $('.delete').removeClass('d-none');
        }

        else{
            
            if($(".searchable tbody tr td input:checked").length < 1){
                $('.delete').addClass('d-none');
            }
        }
    })
}

onSelectBoxItemClick();
function onSelectBoxItemClick(){
    $('.select-box .select-box-item').on("click", function(){
        
        if( $(this).hasClass("select-box-item-active")){
            $(this).find('input').prop('checked', false);
            $(this).removeClass("select-box-item-active");
        }

        else{
            $(this).find('input').prop('checked', true);
            $(this).addClass("select-box-item-active");
        }
        
    });
}


onSelectBoxPageItemClick();
function onSelectBoxPageItemClick(){
    $('.select-box .select-box-page-item').on("click", function(){
        
       

        if( $(this).hasClass("select-box-item-active")){
            $(this).find('input').prop('checked', false);
            $(this).removeClass("select-box-item-active");
        }

        else{
            $('.select-box .select-box-page-item').find('input').prop('checked', false);
            $('.select-box .select-box-page-item').removeClass('select-box-item-active')
            $(this).find('input').prop('checked', true);
            $(this).addClass("select-box-item-active");
            $('input.link-url').val($(this).find('input').val());
        }
        
    });
}


ModalCloseOopenNew();

function ModalCloseOopenNew(){
    $("button[data-toggle='modal-close-open']").on("click", function(){
        var target = $(this).data('target');
        $($(this).data('close')).on('hidden.bs.modal', function (e) {
            $(target).modal('show');
        })
       

        $($(this).data('close')).modal('hide');

        
    })
}
sidebarToggle();
function sidebarToggle(){
    $('a.sidebar-toggle').on("click", function(){
        var sidebar = $('.sidebar');

        if(sidebar.hasClass('sidebar-sm')){
            sidebar.removeClass('sidebar-sm');
            $(this).find('i').removeClass('fa-indent').addClass('fa-outdent');
        }

        else{
            sidebar.addClass('sidebar-sm');
            $(this).find('i').removeClass('fa-outdent').addClass('fa-indent');
        }
    })
}



$('a[data-toggle="list"]').on('shown.bs.tab', function (e) {

    var id = $(this).data('id');

    $.post('/admin/message/seen', {_token: $('meta[name=csrf-token]').attr('content'), id:id});
});

$('select.question-type').on('change', function(){
    var optionSelected = $("select.question-type option:selected");
    var valueSelected = this.value;
    var fields = $('.fields');

    if(valueSelected == 5 || valueSelected == 6){
        if(fields.hasClass('d-none')){
            fields.removeClass('d-none');
            return;
        }
    }

    else if(!fields.hasClass('d-none')){
        fields.addClass('d-none');
        return;
    }
});

$(document).on('change','select.question-field-type',  function(){
   
    var valueSelected = this.value;
    console.log(valueSelected);
    if(valueSelected == 5){
        var optionsInput = $(this).parent().find('input')[3];
        $(optionsInput).removeClass('d-none');
        $(optionsInput).prev().addClass('mr-1');
    }

    else if(valueSelected == 7){
        var optionsInput = $(this).parent().find('input')[4];
        var valuesInput = $(this).parent().find('input')[2];
        $(valuesInput).addClass('d-none');
        $(optionsInput).removeClass('d-none');
        $(optionsInput).prev().addClass('mr-1');
    }

    else{
        var optionsInput = $(this).parent().find('input')[3];
        if( !$(optionsInput).hasClass('d-none')){
            $(optionsInput).addClass('d-none');
            $(optionsInput).prev().removeClass('mr-1');
        }
       
    }
});

var clickedOption = 1;

$("button.add-field").on('click', function(){
    var count = $(this).parent().next('.fields-container').children().length;
    var clonable = $('.field-template');
    var clone = clonable.clone();
    $(".conditions").removeClass('d-none');
    
    clone.removeClass('d-none').removeClass('field-template');
    clone.find('label').empty().append("#" + count);
    $(clone.find('select')[0]).prop('name', 'fields['+ count +'][type]');
    $(clone.find('input')[0]).prop('name', 'fields['+ count +'][label]');
    $(clone.find('input')[1]).prop('name', 'fields['+ count +'][name]');
    $(clone.find('input')[2]).prop('name', 'fields['+ count +'][value]');
    $(clone.find('input')[3]).prop('name', 'fields['+ count +'][options]');
    $(clone.find('input')[4]).prop('name', 'fields['+ count +'][download]');
    $(clone.find('input')[5]).prop('name', 'fields['+ count +'][order]');

    $('.fields-container').append(clone);
    $('.fields-container').removeClass('d-none');

    var fields = $('.fields-container').children();
    $('select.question-condition-fields').empty();
    fields.each(function(field){
        if(field > 0){
            $('select.question-condition-fields').append("<option value='"+field+"'> field #"+ field +"</option>");
        
        }
    });

});





$(document).on('click', 'button.add-validation', function(){
   
    var count = $(this).parent().next('.validations-container').children().length;

    var _clonable = $($(this).parent().next().children()[0]);
    
    var parentFieldName = $(this).parent().parent().parent().find('input')[0].name.replace("[label]", "");
   
    console.log(parentFieldName);
    var clone = _clonable.clone();
    
    clone.removeClass('d-none').removeClass('validations-template');
    
    clone.find('label').empty().append("#" + count);
    //console.log(clone, clone.find('select'));
    clone.find('select').prop('name', parentFieldName + '[validation]['+count+'][type]');
    clone.find('input').prop('name',  parentFieldName + '[validation]['+count+'][value]');
    $(this).parent().next('.validations-container').append(clone);
    $(this).parent().next('.validations-container').removeClass('d-none');
});


var clickedCondition = 1;

$("button.add-condition").on('click', function(){
    var count = $(this).parent().next('.conditions-container').children().length;

    var clonable = $('.conditions-template');
    var clone = clonable.clone();

    clone.removeClass('d-none').removeClass('conditions-template');
    clone.find('label').empty().append("#" + count);
    $(clone.find('select')[0]).prop('name', 'conditions['+ count +'][field]');
    $(clone.find('select')[1]).prop('name', 'conditions['+ count +'][type]');
    $(clone.find('input')[0]).prop('name', 'conditions['+ count +'][value]');
    $(clone.find('select')[2]).prop('name', 'conditions['+ count +'][action]');
    $(clone.find('input')[1]).prop('name', 'conditions['+ count +'][date]');
    $('.conditions-container').append(clone);
    $('.conditions-container').removeClass('d-none');
    
});



$(document).on('click', 'button.delete-validation', function(e){
    e.preventDefault();
    var parent = $(this).parent().parent();

    $(this).parent().remove();

    var container = parent.children();
    container.each(function(index){
        if(index > 0){
            $($(container[index]).children()[0]).empty().text("#" + index);
        }
    });
});

$(document).on('click', 'button.delete-field', function(e){
    e.preventDefault();

    var R = confirm('Deleting this field will remove any condition configuration.');


   
    var fields = $('.fields-container').children();
    var parent = $(this).parent().parent();

    if(R){
        $(this).parent().remove();

        var container = parent.children();
        container.each(function(index){
            if(index > 0){
                $($(container[index]).children()[0]).empty().text("#" + index);
            }
           
        });
    
        
        $('select.question-condition-fields').empty();
        fields.each(function(field){
            if(field > 0){
                $('select.question-condition-fields').append("<option value='"+field+"'> field #"+ field +"</option>");
            
            }
        });
    }

    return false;
   
});

$(document).on('click', 'button.delete-condition', function(e){
    e.preventDefault();
    $(this).parent().remove();
});

$('table tr td.clickable').on("click", function(e){
    console.log("clicked");
    if(!$(e.target).is('input') && !$(e.target).is('label')){
        window.location.href = $(this).parent().data('href');
    }
    
});


$('button.export').on('click', function(){
    $('form.exports').submit();
});
