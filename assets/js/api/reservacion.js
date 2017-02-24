var SLIDER = null;

$(function() {
	
	//  Eventos de Botones
	$(".btnSearch").click(function() {
		getSearch();
	});
	$("#txtSearch").keypress(function(e) {
	    if(e.which == 13) { getSearch(); }
	});
    
    $('#txtFechaIni, #txtFechaFin, #txtShowCo').change(function() {
        getSearch();
    });
    
    $("#btnUpdateModal").click(function() {
		updateRow($(this).attr("attr-id"), $("#selEstado").val());
	});

	// Init data
	getSearch();
});

/**
 * Replace All Function
 */
 String.prototype.replaceAll = function(find, replace){
    return this.replace(new RegExp(find, 'g'), replace);
}

/**
 * Arma la tabla del catalogo
 */
function setRowTable(data){
	// Template Row
	var tmpRows = "";
	var templateR = "";
	var template = "<tr><td class='idRow'>CODE</td>"+
        "<td><a class='editRow' attr-id='INDEX' data-toggle='modal' data-target='.modal-edit'>CLIENTE<a></td>"+
        "<td>ESTADO</td>"+
        "<td>LLEGADA</td>"+
        "<td>SALIDA</td>"+
        "<td>HABITACION</td>"+
        "<td>PRECIO</td></tr>";

	// Recorrer elementos
	for(i = 0; i < data.length; i++){
		templateR = template;
        templateR = templateR.replaceAll("INDEX", data[i].id);
		templateR = templateR.replaceAll("CODE", data[i].codigo);
		templateR = templateR.replaceAll("CLIENTE", data[i].completo);
        templateR = templateR.replaceAll("LLEGADA", data[i].fechaLlegada);
        templateR = templateR.replaceAll("SALIDA", data[i].fechaSalida);
        templateR = templateR.replaceAll("ESTADO", data[i].estado);
        
        var precio = 0;
        var rooms = "";
        var habitaciones = data[i].habitaciones;
        for(x = 0; x < habitaciones.length; x++){
            precio += parseFloat(habitaciones[x].precio);
            if (rooms != ""){rooms += "<br/>"}
            rooms += habitaciones[x].nombre + " ("+(parseFloat(habitaciones[x].precio)).formatMoney(0, "$", ",", ".")+")";
        }
        templateR = templateR.replaceAll("HABITACION", rooms);
        templateR = templateR.replaceAll("PRECIO", precio.formatMoney(0, "$", ",", "."));
        
        
		tmpRows += templateR;
	}
	$("#bodyTable").html(tmpRows);

	
	$(".editRow").click(function() {
        $("#btnUpdateModal").attr("attr-id", $(this).attr("attr-id"));
        $("#txtNombre").html($(this).html());
        $("#txtLlegadaSalida").html($($(this).parent().parent().children()[3]).html()+
                                    " / "+$($(this).parent().parent().children()[4]).html());
        $("#txtHabitaciones").html($($(this).parent().parent().children()[5]).html());
        $("#txtTotal").html("Total: "+$($(this).parent().parent().children()[6]).html());
        
        var estado = 1;
        if($($(this).parent().parent().children()[2]).html()=="Pagado") estado = 2;
        else if($($(this).parent().parent().children()[2]).html()=="CheckIn") estado = 3;
        else if($($(this).parent().parent().children()[2]).html()=="CheckOut") estado = 4;
        $("#selEstado").val(estado);
	});
}

/**
 * Arma el paginador
 */
function setPaginator(pagina, total){
	// set 
	var pag = "";
	total = parseInt(total);
	pagina = parseInt(pagina);
	if (total > 10){
		total = parseInt(total / 10) + 1;
		for(i = 1; i <= total; i++){
			if (i == pagina){
				pag += "<li class='active'><a>"+i+"</a></li>";
			}else{
				pag += "<li class='btnPagina'><a>"+i+"</a></li>";
			}
		}
	}
	$(".pagination").html(pag);
	$(".btnPagina").click(function(){ getSearch($($(this).children()).html()); });
}

/**
 * Obtiene el registro seleccionado
 */
function updateRow(idRow, idEstado){
	$.ajax({
		type: "POST",
		url: "reservacion/save",
		dataType:'json',
		data: { 
			id: idRow, 
            estadoReservacionId: idEstado
		},
		success: function(data){
			reloadSearch();
		}
	});
}

/**
 * Recarga la busqueda y considera paginacion :)
 */
function reloadSearch(){
	if ($(".pagination").find(".active a").length > 0){
		var pagina = parseInt($($(".pagination").find(".active a")[0]).html());
		getSearch(pagina);
	}else{
		getSearch();
	}
}

/**
 * Obtiene la busqueda de los registros activos del catalogo
 */
function getSearch(pagina){
    $.ajax({
		type: "POST",
		url: "reservacion/getSearch",
		dataType:'json',
		data: { 
			texto: $("#txtSearch").val(),
            fechaIni: $("#txtFechaIni").val(),
            fechaFin: $("#txtFechaFin").val(),
            showCo: $("#txtShowCo").is(':checked'),
			pagina: ((typeof pagina == 'undefined')?1:pagina)
		},
		success: function(data){
			setRowTable(data.data);
			setPaginator(data.pagina, data.total);
		}
	});
}