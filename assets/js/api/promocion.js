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

	// Vigencia
	$('#startDate').datepicker()
	.on('changeDate', function(ev){
		if (ev.date.valueOf() > getFecha($('#endDate').attr('data-date'))){
			$('#alert').hide();
			$('#alert').show("slow");
		} else {
			$('#alert').hide();
			changeDate(this, ev.date);
		}
		$('#startDate').datepicker('hide');
	});
	$('#endDate').datepicker()
	.on('changeDate', function(ev){
		if (ev.date.valueOf() < getFecha($('#startDate').attr('data-date'))){
			$('#alert').hide();
			$('#alert').show("slow");
		} else {
			$('#alert').hide();
			changeDate(this, ev.date);
		}
		$('#endDate').datepicker('hide');
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
    setRoom();
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
		"<td>INICIO</td>"+
        "<td>FIN</td>"+
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
		templateR = templateR.replace("INICIO", data[i].fechaInicio);
		templateR = templateR.replace("FIN", data[i].fechaFin);
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
 * Arma la tabla del catalogo
 */
function setRoom(){
    $.ajax({
		type: "POST",
		url: "habitacion/getAll",
		dataType:'json',
		data: { 
			texto: $("#txtSearch").val(),
			pagina: ((typeof pagina == 'undefined')?1:pagina)
		},
		success: function(data){
			// Template Row
            var tmpRows = "<tr><th width='230px'>Nombre</th><th>Precio</th><th>Adulto Extra</th><th>Niño Extra</th></tr>";
            var templateR = "";
            var template = "<tr class='roomPrice' id='roomINDEX' attr-id='INDEX'>" +
                "<td>NOMBRE</td>" +
                "<td><div class='input-group'><span class='input-group-addon'>$</span>"+
                    "<input type='text' class='form-control newPrice newStd' placeholder='BASE'></td>" +
                "<td><div class='input-group'><span class='input-group-addon'>$</span>"+
                    "<input type='text' class='form-control newPrice newAdulto' placeholder='ADULTO'></td>" +
                "<td><div class='input-group'><span class='input-group-addon'>$</span>"+
                    "<input type='text' class='form-control newPrice newNino' placeholder='NINO'></td></tr>";

            // Recorrer elementos
            for(i = 0; i < data.length; i++){
                templateR = template;
                templateR = templateR.replaceAll("INDEX", data[i].id);
                templateR = templateR.replace("NOMBRE", data[i].nombre);
                templateR = templateR.replace("BASE", (parseFloat(data[i].precioStd)).formatMoney(0, "", ",", "."));
                templateR = templateR.replace("ADULTO", (parseFloat(data[i].precioAdultoExtra)).formatMoney(0, "", ",", "."));
                templateR = templateR.replace("NINO", (parseFloat(data[i].precioNinioExtra)).formatMoney(0, "", ",", "."));
                tmpRows += templateR;
            }
            $("#bodyRooms").html(tmpRows);
		}
	});
}

/**
 * Limpiar el formulario del catalogo
 */
function clearData(){
	$("#hideID").val('0');
	$("#txtNombre").val('');
	changeDate('#startDate', new Date());
	changeDate('#endDate', new Date());
    $(".bg-danger").hide();
    $("#inDate").hide();
    $(".newPrice").val('');
    $("#bodyRooms").scrollTop(0);
}

/**
 * Limpiar el formulario del catalogo
 */
function validateForm(){
	if ($("#txtNombre").val() ==''){
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
		url: "promocion/get",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
			$("#hideID").val(data[0].id)
			$("#txtNombre").val(data[0].nombre);
			changeDate('#startDate', getFecha(data[0].fechaInicio));
			changeDate('#endDate', getFecha(data[0].fechaFin));
		}
	});
    
    // Load prices
    $.ajax({
		type: "POST",
		url: "promocion/getHabitaciones",
		dataType:'json',
		data: { 
			id: idRow
		},
		success: function(data){
            for(i = 0; i < data.length; i++){
                if ($("#room"+data[i].habitacionId).length > 0){
                    $("#room"+data[i].habitacionId).find(".newStd").val((data[i].precioStd == 'null')?'':data[i].precioStd);
                    $("#room"+data[i].habitacionId).find(".newAdulto").val((data[i].precioStd == 'null')?'':data[i].precioAdultoExtra);
                    $("#room"+data[i].habitacionId).find(".newNino").val((data[i].precioStd == 'null')?'':data[i].precioNinioExtra);
                }
            }
		}
	});
}

/**
 * Obtiene el registro seleccionado
 */
function deleteRow(idRow){
	$.ajax({
		type: "POST",
		url: "promocion/delete",
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
			url: "promocion/save",
			dataType:'json',
			data: { 
				id:  $("#hideID").val(),
				nombre: $("#txtNombre").val(),
				fechaInicio: $('#startDate').attr('data-date'),
				fechaFin: $('#endDate').attr('data-date'),
				status: 1
			},
			success: function(data){
                if (typeof data.error != "undefined"){
                    $("#inDate").html("Las fechas coinciden con la promocion: "+data.data.nombre+"<br/> ("+data.data.fechaInicio+" - "+data.data.fechaFin+")");
                    $("#inDate").show("slow");
                }else{
                    // Save prices
                    var arrayId = "", arrayStd = "", arrayAdulto = "", arrayNino = "";
                    var size = $(".roomPrice").length;
                    for(i = 0; i < size; i++){
                        // Concatenar separador
                        arrayId += (arrayId == "")?"":"-";
                        arrayStd += (arrayStd == "")?"":"-";
                        arrayAdulto += (arrayAdulto == "")?"":"-";
                        arrayNino += (arrayNino == "")?"":"-";
                        // Concatenar valor
                        arrayId += $($(".roomPrice")[i]).attr("attr-id");
                        arrayStd += $($(".newStd")[i]).val();
                        arrayAdulto += $($(".newAdulto")[i]).val();
                        arrayNino += $($(".newNino")[i]).val();
                    }
                    $.ajax({
                        type: "POST",
                        url: "promocion/saveHabitacion",
                        dataType:'json',
                        data: { 
                            id: data.id,
                            arrayId: arrayId,
                            arrayStd: arrayStd,
                            arrayAdulto: arrayAdulto,
                            arrayNino: arrayNino
                        },
                        success: function(data){
                            
                        }
                    });
                    // Return screen
                    clearData();
                    reloadSearch();
                    SLIDER.prev();
                    $(".bg-info").show("slow");
                    setTimeout(function() { $(".bg-info").hide("slow"); }, 3000);
                }
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
		url: "promocion/getSearch",
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