$(document).ready(function(){
	
	$('#user').focus(function() {
		$('#div_email').css('backgroundPosition', "left -136px");
	});
	$('#user').blur(function(){
		$('#div_email').css('backgroundPosition', "left 11px");
	});
	
	$('#password').focus(function() {
		$('#div_password').css('backgroundPosition', "left -136px");
	});
	$('#password').blur(function(){
		$('#div_password').css('backgroundPosition', "left 11px");
	});
	
	$('#user').keyup(function(event) {
		if($('#user').val() != "")
			$('#login_email').html("");
		else
			$('#login_email').html("Usuario");
		if (event.keyCode == '13')
			login();
	});
	$('#password').keyup(function(event) {
		if($('#password').val() != "")
			$('#login_password').html("");
		else
			$('#login_password').html("Password");
		if (event.keyCode == '13')
			login();
	});	

});

/**
 * Validamos campos de logueo
 */
function login(){
	
	// Validaciones
	if($('#user').val() == "" || $('#password').val() == "" ){
		$('#error_container').css('display', "");
		$('#error_msg').html("Introduce el usuario y password &nbsp;;)");
		if($('#user').val() == ""){
			$('#user').focus();
			$('#div_email').css('backgroundPosition', "left -283px");
		}else{
			$('#password').focus();
			$('#div_password').css('backgroundPosition', "left -283px");
		}
		return;
	}
	
	
	$.post('LoginController/isValidUser',{
		'usuario'	: $('#user').val(),
		'password'	: $('#password').val()
		},function(jsonData) {
			if(jsonData.error=="1")
				document.location = "ReservacionesController";
			else{
				$('#error_msg').html("El usuario o password es incorrecto &nbsp;:/");
				$('#user').focus();
				$('#div_email').css('backgroundPosition', "left -283px");
				$('#error_container').css('display', "");
			}
		},
	"json");
}
