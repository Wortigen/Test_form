$(document).ready(function (){
   $('#formSend').submit(function(e){
       e.preventDefault();
        clear($('#formSend'));
       if(validate($('#formSend .row'))){
           $('.server_answer').html('');
           $('.server_answer').css("display", "none");
           $.ajax({
               url: '/add_user',
               type: 'post',
               data: $('form').serializeArray(),
               success: function( data, textStatus, jQxhr ){
                   $('.server_answer').append(data);
                   $('.server_answer').css("display", "flex");
                   console.log($('.server_answer h3'));
                   if($('.server_answer h3').length > 0){
                       console.log('hide form');
                       $('#formSend')[0].classList.add('wts_hide');
                       // $('#formSend').toggle();
                   }
                   console.log(data);
               },
               error: function( jqXhr, textStatus, errorThrown ){
                   console.log( errorThrown );
               }
           });
       }
   });
});

function validate(row_field){
    var result = true;

    var inp = row_field.find('input');

    inp.each(function (index){
        if(inp[index].value == ''){
            var error = inp[index].closest('.row').querySelectorAll('.invalid-feedback');
            if(error.length == 2){
                error[0].style.display = "flex";
                error[1].style.display = "flex";
            } else {
                error[0].style.display = "flex";
            }
            result = false;
        }
    });

    return result;
}

function clear(form){
    var inp = form.find('input');

    inp.each(function (index){
            var error = inp[index].closest('.row').querySelectorAll('.invalid-feedback');
            if(error.length == 2){
                error[0].style.display = "none";
                error[1].style.display = "none";
            } else {
                error[0].style.display = "none";
            }
            result = false;
        });
}