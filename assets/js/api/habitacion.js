var SLIDER = null;

$(function() {
	
	//  Eventos de Botones
	$(".btnSearch").click(function() {
		getSearch();
	});
	$("#txtSearch").keypress(function(e) {
	    if(e.which == 13) { getSearch(); }
	});
	$(".btnAdd").click(function() {
		SLIDER.next();
	});
	$("#btnDeleteModal").click(function() {
		deleteRow($(this).attr("attr-id"));
	});
	$("#btnGuardar").click(function() {
		save();
	});
	$("#btnCancelar").click(function() {
		clearData();
		SLIDER.prev();
	});

	// Slider
	$("#slider").owlCarousel({
		navigation : false,
		slideSpeed : 500,
		paginationSpeed : 400,
		singleItem:true,
		mouseDrag: false,
		touchDrag: false
  	});
  	SLIDER = $("#slider").data('owlCarousel')

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
function setRowTable(pagina, data){
	// Template Row
	var tmpRows = "";
	var templateR = "";
	var template = "<tr><td class='idRow'>INDEX</td>"+
        "<td><a class='editRow' attr-id='ID'>NOMBRE<a></td>"+
		"<td align='center'>DISPO</td>"+
        "<td align='center'>PRECIO</td>"+
        "<td align='center'>NINO</td>"+
        "<td align='center'>ADULTO</td>"+
        
        "<td width='80'>"+
          "<a href='#' attr-id='ID' attr-name='NOMBRE' title='Eliminar' class='btn btn-danger btn-xs btnDelete' style='margin-left: 20px;'"+
          " data-toggle='modal' data-target='.modal-delete'><i class='fam-delete'></i></a>"+
        "</td></tr>";

	// Recorrer elementos
	for(i = 0; i < data.length; i++){
		templateR = template;
		templateR = templateR.replace("INDEX", (i+1+((pagina-1)*10)));
		templateR = templateR.replaceAll("ID", data[i].id);
		templateR = templateR.replaceAll("NOMBRE", data[i].nombre);
		templateR = templateR.replace("DISPO", data[i].disponibilidad);
		templateR = templateR.replace("PRECIO", (parseFloat(data[i].precioStd)).formatMoney(0, "$", ",", "."));
		templateR = templateR.replace("NINO", (parseFloat(data[i].precioAdultoExtra)).formatMoney(0, "$", ",", "."));
		templateR = templateR.replace("ADULTO",(parseFloat(data[i].precioNinioExtra)).formatMoney(0, "$", ",", "."));
		tmpRows += templateR;
	}
	$("#bodyTable").html(tmpRows);

	// Eventos de los botones
	$(".editRow").click(function() {
		SLIDER.next();
		consultar($(this).attr("attr-id"));
	});
	$(".btnDelete").click(function() {
		$("#delNombre").html($(this).attr("attr-name"));
		$("#btnDeleteModal").attr("attr-id", $(this).attr("attr-id"));
	});

	clearData();
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
 * Limpiar el formulario del catalogo
 */
function clearData(){
	$("#hideID").val('0');
	$("#txtNombre").val('');
	$("#txtDisponibilidad").val('1');
	$("#txtDescripcion").val('');
	$("#txtCapacidad").val('1');
	$("#txtPrecio").val('0.0');
	$("#txtAdulto").val('0.0');
	$("#txtNino").val('0.0');
	$(".bg-danger").hide();
}

/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#txtNombre").val() =='' ||
		$("#txtDisponibilidad").val() =='' ||
		$("#txtDescripcion").val() =='' ||
		$("#txtCapacidad").val() =='' ||
		$("#txtPrecio").val() =='' ||
		$("#txtAdulto").val() =='' ||
		$("#txtNino").val() ==''){
		$(".bg-danger").show("slow");
		return false;
	}
	return true;
}

/**
 * Obtiene el registro seleccionado
 */
function consultar(idRow){
	$.ajax({
		type: "POST",
		url: "habitacion/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			$("#hideID").val(data[0].id)
			$("#txtNombre").val(data[0].nombre);
			$("#txtDisponibilidad").val(data[0].disponibilidad);
			$("#txtDescripcion").val(data[0].descripcion);
			$("#txtCapacidad").val(data[0].capacidadStd);
			$("#txtPrecio").val(data[0].precioStd);
			$("#txtAdulto").val(data[0].precioAdultoExtra);
			$("#txtNino").val(data[0].precioNinioExtra);
		}
	});
}

/**
 * Obtiene el registro seleccionado
 */
function deleteRow(idRow){
	$.ajax({
		type: "POST",
		url: "habitacion/delete",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			reloadSearch();
		}
	});
}


/**
 * Guarda el registro
 */
function save(){
	if (validateForm()){
		$.ajax({
			type: "POST",
			url: "habitacion/save",
			dataType:'json',
			data: { 
				id:  $("#hideID").val(),
				nombre: $("#txtNombre").val(),
				disponibilidad: $("#txtDisponibilidad").val(),
				descripcion: $("#txtDescripcion").val(),
				capacidadStd: $("#txtCapacidad").val(),
				precioStd: $("#txtPrecio").val(),
				precioAdultoExtra: $("#txtAdulto").val(),
				precioNinioExtra: $("#txtNino").val(),
				status: 1
			},
			success: function(data){
				clearData();
				reloadSearch();
				SLIDER.prev();
				$(".bg-info").show("slow");
				setTimeout(function() { $(".bg-info").hide("slow"); }, 3000);
			}
		});
	}
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
		url: "habitacion/getSearch",
		dataType:'json',
		data: { 
			texto: $("#txtSearch").val(),
			pagina: ((typeof pagina == 'undefined')?1:pagina)
		},
		success: function(data){
			setRowTable(data.pagina, data.data);
			setPaginator(data.pagina, data.total);
		}
	});
}