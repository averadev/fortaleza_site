
var grid = "#ReservesdGrid";
var controller = 'AvailabilityController/allAvailable';

$(document).ready(function(){
	$("#startDate").datepicker();
	$("#endDate").datepicker();
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
		colNames	: [ 'Tipo de habitacion','Hab. asignadas','Hab. Reservadas','Hab. Disponibles'],		
		colModel	: [
		   
		   {name:'roomType',		index:'roomType',		width:100,	sortable:false, editable:false, resizable:false, cellattr: function (rowId,tv,rawObject,cm,rdata) { return 'style="white-space: normal;"' }},
		   {name:'assigned',		index:'assigned',		width:100,	sortable:false, editable:false, resizable:false, align : 'center', },
		   {name:'reserved',		index:'reserved',		width:100,	sortable:false, editable:false, resizable:false, align:'center'},
		   {name:'available',		index:'available',		width:100,	sortable:false, editable:false, resizable:false, align:'center'} 
		   	
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
		sortname	: 'roomType',
		viewrecords	: true,
		hidegrid	: false,
		caption		: "Consulta de Disponibilidad",
		pager		: "#resPager",
		/*scroll		: 1,*/
		/*scrollrows	: true,*/
		altRows 	: true		
	});	
}

function doSearch(){
	
}

