
$(function() {
	
    $("#btnSend").click(function() {
		sendContact();
	});
    
});

function sendContact(){
    var isReady = true;
    // Validar empty
    elems = new Array("#txtNombre","#txtTelefono","#txtEmail","#txtMsg");
    for(i = 0; i < elems.length; i++){
        if ($(elems[i]).val() == ""){
            isReady = false;
            $(elems[i]).addClass("redLine");
        }else{
            $(elems[i]).removeClass("redLine");
        }
    }
    // Validar email format
    if(!isEmail($("#txtEmail").val())){
        isReady = false;
        $("#txtEmail").addClass("redLine");
    }
    
    if (isReady){
        
        var request = $.ajax({
            type: "POST",
            url: "contacto/sendEmail",
            dataType:'json',
            data: { 
                txtNombre: $("#txtNombre").val(),
                txtTelefono: $("#txtTelefono").val(),
                txtEmail: $("#txtEmail").val(),
                txtMsg: $("#txtMsg").val()
            }
        });
        
        request.done(function( msg ) {
          endSend();
        });

        request.fail(function( jqXHR, textStatus ) {
          endSend();
        });
    }
}

function endSend(){
    $("#txtNombre").val('');
    $("#txtTelefono").val('');
    $("#txtEmail").val('');
    $("#txtMsg").val('');
    new Messi('El mensaje fue enviado.', {title: 'Contacto'});
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}