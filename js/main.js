$(document).ready(function (){
   $('#formSend').submit(function(e){
       e.preventDefault();

       if(validate($('#formSend .row'))){
           $.ajax({
               url: '/add_user',
               type: 'post',
               data: $(this).serialize(),
               success: function( data, textStatus, jQxhr ){
                   console.log('success');
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
    var inp_error = row_field.find('.valid-check');

        console.log(inp);
        console.log(inp_error);

    var pass = '';
    var repass = '';

    for(let i = 0; i < inp.length;i++){

    }

    return result;
}