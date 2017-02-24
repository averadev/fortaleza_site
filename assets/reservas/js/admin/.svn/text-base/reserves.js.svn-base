
var grid = "#ReservesdGrid";
var controller = 'ReservacionesController/allReserve';

$(function() {
		$( "#dialog" ).dialog({autoOpen: false});
});

$(document).ready(function(){
	var now = new Date();
	now.getMonth();
	
	$("#startDate").datepicker();
	$("#endDate").datepicker();
	$("#startDate").val("01/"+(now.getMonth()+1)+"/"+now.getFullYear());
	$("#endDate").val(daysInMonth(now.getFullYear(),now.getMonth())+"/"+(now.getMonth()+1)+"/"+now.getFullYear());
	$("#btnSearch").click(function(){
		$(grid).reloadGrid();
	});	
	$("#selRoomType").change(function(){
		$(grid).reloadGrid();
	});
	reserveModel();
});

function reserveModel(){
	
	$(grid).jqGrid({
		url			: controller,
		datatype	: 'json',
		mtype		: 'POST',
		colNames	: [ 'No. Res','Cliente','Llegada','Salida','Tipo Habitacion','#','Precio','Cod. promocion','Estatus', 'Telefono', 'Email'],		
		colModel	: [
		   
		   {name:'reserveCode',		index:'reserveCode',	width:30,	sortable:false, editable:false, resizable:false, align : 'center', cellattr: function (rowId,tv,rawObject,cm,rdata) { return 'style="white-space: normal;"' }},
		   {name:'customer',		index:'customer',		width:80,	sortable:false, editable:false, resizable:false, edittype:'select', formatter:'showlink', formatoptions:{baseLinkUrl:'javascript:', showAction: "getCustomer('", addParam: "');"}},
		   {name:'arrivedate',		index:'arriveDate',		width:30,	sortable:false, editable:false, resizable:false, align:'center'},
		   {name:'departureDate',	index:'departureDate',	width:30,	sortable:false, editable:false, resizable:false, align:'center'},
		   {name:'roomType',		index:'roomType',		width:100,	sortable:false, editable:false, resizable:false },
		   {name:'nRoom',			index:'nRoom',			width:10,	sortable:false, editable:false, resizable:false, align:'center' },
		   {name:'price',			index:'price',			width:50,	sortable:false, editable:false, resizable:false, align:'right'},
		   {name:'nRooms',			index:'nRooms',			width:50,	sortable:false, editable:false, resizable:false},
		   {name:'status',			index:'status',			width:40,	sortable:false, editable:false, resizable:false, align:'center'},
		   {name:'telefono',		index:'telefono',		width:1,	hidden:true},
		   {name:'email',			index:'email',			width:1,	hidden:true}
		   	
		],
		postData	:{
			"startDate" : function(){ return $("#startDate").val() },
			"endDate"	: function(){ return $("#endDate").val() },
			"roomType"	: function(){ return $("#selRoomType").val() }
		},
		height		: 300,
		width		: 960,
		jsonReader	: {root:"rows",repeatitems : true},		
		gridModel	: true,
		rowNum		: 10,
		sortorder	: "ASC",
		sortname	: 'reserveCode',
		viewrecords	: true,
		hidegrid	: false,
		caption		: "Reservaciones",
		pager		: "#resPager",
		/*scroll		: 1,*/
		/*scrollrows	: true,*/
		altRows 	: true		
	});	
}

function getCustomer(idValue){
	var idRow = idValue.substring(4, idValue.lenght);
	
	$('#lblReserveCode').html($(grid).getCell(idRow, 'reserveCode'));
	$('#lblCustomer').html($(grid).getCell(idRow, 'customer'));
	$('#lblArrivedate').html($(grid).getCell(idRow, 'arrivedate'));
	$('#lblDepartureDate').html($(grid).getCell(idRow, 'departureDate'));
	$('#lblRoomType').html($(grid).getCell(idRow, 'roomType'));
	$('#lblNRoom').html($(grid).getCell(idRow, 'nRoom'));
	$('#lblPrice').html($(grid).getCell(idRow, 'price'));
	$('#lblNRooms').html($(grid).getCell(idRow, 'nRooms'));
	$('#lblTelefono').html($(grid).getCell(idRow, 'telefono'));
	$('#lblEmail').html($(grid).getCell(idRow, 'email'));
	
	$( "#dialog" ).dialog( "open" );
}

function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}

