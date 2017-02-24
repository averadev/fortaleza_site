//Nombre del div que queremos poner en una ventana
var containerName = '#appConteiner';

// Ubicación del ReserveController
var preLocation = '';
if (window.location.href.lastIndexOf("suite/") > -1 || window.location.href.lastIndexOf("room/") > -1){
    preLocation = '../';
}

$(document).ready(
	
);

function showAppConteiner(){
	$('body').append('<div id=modal></div>');	
    // Ubicación del ReserveController
	$.blockUI({ 
		message: '<h1>Cargando...</h1>', 
		overlayCSS: {
			backgroundColor: 'black', 
	        opacity: 1.0
	    } 
	});
	$('#modal').load(
		preLocation + 'reserveController',
		function(){
			$.unblockUI();
            $.colorbox({
	        	href: containerName,
	            inline:true,
	        	open:true,
	        	innerWidth:'965px',
	        	innerHeight:'865px'
            });
         }
	);
}

$(document).bind('cbox_cleanup', function(){
	$('.tipsy').remove();
	$(containerName).remove();
	$('#modal').remove();
});
