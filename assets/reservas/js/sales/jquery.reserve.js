/**
 * author: jpat
 * file:jquery.reservations.js
 * date: 30/11/2011
 *   
 */

// Ubicación del reserveController
window.preLocation = '';
if (window.location.href.lastIndexOf("suite/") > -1 || window.location.href.lastIndexOf("room/") > -1){
    window.preLocation = '../';
}



var regPrice = 3;
var tempPrice = 2;
var promoPrice = 1;
var arrayPrice = new Array();
var adultoXtra;
var ninoXtra;


// Estilos para la capa ajax
var blockStyle = {
	overlayCSS: { backgroundColor: '#E6E6E6' },
	css: { 
		border: 'none', 
		padding: '15px', 
		backgroundColor: '#000', 
		'border-radius' : '5px',
		'-webkit-border-radius': '5px', 
		'-moz-border-radius': '5px',		
		opacity: 0.5, 
		color: '#fff',
		fontSize: '16px'
	},
	message: "Procesando ...",
	fadeIn:  250, 
	fadeOut:  500	 
} 

$(document).ready(function(){
	
	initializeAllPanel();	
	loadNavCtrl();
	loadSliderBox();
	loadPanel(1);

});

function initializeAllPanel(){
	//	Panel 1
	
	var dates = $( "#arriveDate, #departureDate" ).datepicker({
		minDate: new Date(),
		onSelect: function( selectedDate ) {
            
		}
	});
    
    
    
	
	$("#formReservation").validate({	
	    errorClass	: "error",
	    focusInvalid: true,
	    focusCleanup: true,
	    onkeyup		: false,
	    onfocusout	: false,	
		rules:
		{
			arriveDate		: {	required: true},
			departureDate	: {	required: true},
			nRooms			: { required: true, min: 1},
			nAdults			: {	required: true, min: 1},
			nChildren		: {	required: true,	min: 0}			
		},		
		invalidHandler: function(form, validator) {	
			  //do something			
		},
	    submitHandler: function(form) {
	    					
		}		
	});	
	
	$("#selRooms").bind("change",function(){
		$("#peopleBox").html("");
		var n = $(this).val()*1;
		var items = "";
		for(var i=0;i<n;i++){
			 items += 
			"<div id='nPeople"+(i+1)+"' class='nPeople'>"+
				"<div class='adultBox'>"+
					"<label for='nAdults'>Adults:</label>"+
					"<select id='selAdults"+(i+1)+"' name='nAdults'>"+
							"<option value='1'>1</option>"+
							"<option value='2'>2</option>"+
							"<option value='3'>3</option>"+
							"<option value='4'>4</option>"+							
					"</select>" +
				"</div>"+
				"<div class='childBox'>"+
					"<label for='nChildren'>Children:</label>"+
					"<select id='selChildren"+(i+1)+"' name='nChildren'>"+
								"<option value='0'>0</option>"+
								"<option value='1'>1</option>"+
								"<option value='2'>2</option>"+
								"<option value='3'>3</option>"+
								"<option value='4'>4</option>"+										
					"</select>" +
				"</div>" +
				"<div class='childAgeBox'></div>" +
			"</div>";	
		}
		$("#peopleBox").html(items);		
		
	});
	
	
	var opts = {
		formElements:{"ical" : "%d/%m/%Y"},
		/* Tell the script we want a static/inline datePicker */
		staticPos:true,
		/* Tell it also to position the datePicker within a specific DOM node */
		positioned:"someNodeId"
		/*statusFormat:"%l, %d %F %Y"*/
	};
	datePickerController.createDatePicker(opts);
	
	
	//Panel3		
	$("#formCustomer").validate({	
	    errorClass	: "error",
	    focusInvalid: true,
	    focusCleanup: true,
	    onkeyup		: false,
	    onfocusout	: false,	
		rules:
		{
			cName		: {	required: true},
			cPaterno	: {	required: true},				
			cAddress	: {	required: true},				
			cPhone		: {	required: true},
			cEmail		: {	required: true, email: true}			
		},		
		invalidHandler: function(form, validator) {	
			  //do something			
		},
		   submitHandler: function(form) {
		   					
		}		
	});
	
	//Panel4	
	$("#nextIcon4").bind("click",function(){		
		generateReserve();		
	});
}

/**
 * Inicializa los eventos para el navegador de pantalas y los eventos asociados
 */
function loadNavCtrl(){
	
	$("#sliderBoxNav .navItem").bind("click",function(){
		var target = $(this).find(".indexPanel").val()*1;		
		var current = $('#sliderBox').data('AnythingSlider').currentPage*1;		
		if( target == (current+1)){
			// Validar el formulario antes de pasar al sig div.panel			
			if(validatePanel(current)){
				$(".anythingWindow").block(blockStyle);	
				loadPanel(target);
				//Desplazamiento hace el siguiente panel
			    setTimeout(function(){$("#sliderBox").anythingSlider(target)},500);			      
			}		
		}else if(target < current){
//			if(target == 2)
//				parent.resizeIframe(830);
//			else
//				parent.resizeIframe(520);
			var reserved = $("#reserved").val()*1;
			if(reserved == 0) $("#sliderBox").anythingSlider(target);			 
		}	    
	});
	
	$("#sliderBoxNav li:first-child").addClass("currentPanel");
	
	$(".nextButtom").bind("click",function(){
		var current = $('#sliderBox').data('AnythingSlider').currentPage;
		//Validacione del formulario de panel actual
		if( validatePanel(current)){
			$(".anythingWindow").block(blockStyle);			
			//Desplazamiento hace el siguiente panel			
			loadPanel(current+1);
			setTimeout(function(){$("#sliderBox").anythingSlider(current+1)},500);
		}	
				
	});
}

function changeNavIcon(pos){	
	switch(pos){
	case 1:
		$("#sliderBoxNav").css({backgroundPosition:'0px 0px'});
		break;
	case 2:
		$("#sliderBoxNav").css({backgroundPosition:'0px -65px'});
		break;
	case 3:
		$("#sliderBoxNav").css({backgroundPosition:'0px -130px'});
		break;
	case 4:
		$("#sliderBoxNav").css({backgroundPosition:'0px -195px'});
		break;
	}
}

function loadSliderBox(){
	
	$("#sliderBox").anythingSlider({
		theme			: 'default',
		startPanel		: 1,		
		buildNavigation : false,
		autoplay		: false,		
		buildStartStop	: false,
		buildArrows		: false,
		infiniteSlides	: false,
		onSlideBegin	: function(){
			$(".tipsy").remove();
		},
		onSlideComplete : function(slider){
			$("#sliderBoxNav").find(".currentPanel").removeClass("currentPanel");
			$($("#sliderBoxNav .navItem")[slider.currentPage-1]).addClass("currentPanel");	
			changeNavIcon(slider.currentPage);
			$(".anythingWindow").unblock();
		}
	});
}

/**
 * Validado de vistas (Panel)
 * @param indexP
 * @returns {Boolean}
 */
function validatePanel(indexP){	
	var valid = false;
	switch(indexP){
		case 1:						
			valid =  $("#formReservation").valid();			
			break;
		case 2:
			var allTables = $("div[id^='tmpRoom']");
			for(var i=0; i<allTables.length; i++){
				if($(allTables[i]).find(".tableRooms").hasClass("roomSelected")){
					valid =  true;					
				}
			}
			$(".anythingWindow").block({
				overlayCSS: { backgroundColor: 'none', cursor : 'default'  },
				css: { 
					border			: 'none', 
					padding			: '15px',
					backgroundColor	: '#3c3c3c', 
					'border-radius' : '5px',
					'-webkit-border-radius': '5px', 
					'-moz-border-radius': '5px',					
					color			: '#FFF',
					opacity			: 0.8,
					fontSize		: '16px',
					fontWeight		: 'bold',
					cursor			: 'default' 
				},
				message: "Seleccione una habitacion ",
				fadeIn:  250, 
				fadeOut:  500	 
			} );
			
			setTimeout(function(){$(".anythingWindow").unblock()}, 1500);
			break;		
		case 3:			
			valid =  $("#formCustomer").valid();
			break;
		default:
			//
	}	
	return valid;
}

function loadPanel(panel){	
//	parent.resizeIframe(520);
	switch(panel){
		case 1: loadPanel1(); break;
		case 2: loadPanel2(); break;
		case 3: loadPanel3(); break;
		case 4: loadPanel4(); break;
		default: //nothing
	}	
}

function numberFormatter(val){	
	if( val != 0)	
		return $.formatNumber(val, {format:"$ #,###.00", locale:"us"});
	 else
		 return "0.00";
}


/****************************************************************************************************************/
/** Panel 1*/
/****************************************************************************************************************/

function loadPanel1(){		
	
}

function getDataPanel1(){	
	
	return {
			'arriveDate'	: $("#arriveDate").val(),
			'departureDate'	: $("#departureDate").val(),
			'nRooms'		: $("#selRooms").val(),
			'nAdults'		: getGuestNumber("selAdults"),
			'nChildren'		: getGuestNumber("selChildren"),
			'nAdultExtra'	: 1,
			'nChildExtra'	: 1,
			'strArriveDate' : toSpanishDate($("#arriveDate").datepicker("getDate")),
			'strDepartureDate' : toSpanishDate($("#departureDate").datepicker("getDate"))
	};
}

function getGuestNumber(selector){
	
	var n = 0;
	$.each($("select[id^='"+selector+"']"),function(){
		n = $(this).val()*1 + n;
	})
	return n;	
}

/**
 * Encuenta cuantos adultos extra existen segun una capacidad
 * @param capacicty
 */
function findExra(capRoom){
	
	var rooms = $("#selRooms").val()*1
	var adults= [];
	var childs=[];
	for( var i=0; i<rooms; i++ ){
		var nAdult = $("#selAdults"+(i+1)).val()*1
		var nChild = $("#selChildren"+(i+1)).val()*1	
		if( (nAdult+nChild)> capRoom){			
			adults.push(findAdultExtra(nAdult,capRoom));
			childs.push(findChildExtra(nAdult,nChild,capRoom));		
		}
	}
	
	var adultExtra = 0;
	var childExtra = 0;
	for( var i=0; i<adults.length;i++){
		adultExtra += adults[i];		
	}
	for( var i=0; i<childs.length;i++){
		childExtra += childs[i];
	}
	
	var extra = { 'nAdultExtra' : adultExtra, 'nChildExtra' : childExtra};	
	return extra;
}

function findAdultExtra(cAdult,cap){
	
	var r = cAdult - cap;
	if(r>0){
		return r;		
	}
	return 0;
	
}

function findChildExtra(cAdult,cChild,cap){
	var r = cAdult - cap;
	if(r>=0){
		return cChild;
	}else{
		return ((cChild) + (r));
	}	
}

/****************************************************************************************************************/
/** Panel 2*/
/****************************************************************************************************************/

function loadXtraPeople(){
	adultoXtra = getGuestNumber("selAdults");
	ninoXtra = getGuestNumber("selChildren");
}

function loadPanel2(){
//	parent.resizeIframe(830);			
	$("#reserveTotal").html("Total: $ 0.00 "+CURRENCY);
	adultoXtra = getGuestNumber("selAdults");
	ninoXtra = getGuestNumber("selChildren");
	$.post(
		window.preLocation + "reserveController/getRoomsAvaliable",
		getDataPanel1(),
		function(jsonData){		
			var allRooms = (jsonData.length != 0)? jsonData.result : [];
			var available = (jsonData.length != 0)? jsonData.available : [];
			var reserveInfo = getDataPanel1();		
			
			$("#roomConteiner").html(createRoomHeader(allRooms,available,reserveInfo));			
			loadRoomInfo(reserveInfo,allRooms,available);
		},
		"json"
	);	
	$("#roomConteiner").val("");
};


function createRoomHeader(rooms,available,reserveInfo){
	
	$("#reserveRange").html(
			"<span class='titleArrive'>Arrival:</span> <span class='txtArrive'>"+reserveInfo.strArriveDate+"</span>"+
			"<br/><span class='titleDeparture'>Departure: </span> <span class='txtDeparture'>"+reserveInfo.strDepartureDate+"</span>"
	);
	
	var roomItem = "";
	for(var i=0; i<rooms.length; i++){
		var item = rooms[i];
		$.extend(item,available[i]);
		roomItem +=	"<div class='roomItem'>"+
			"<div class='roomTypeName'>"+item.name+"</div>"+
			"<div class='roomDescription'>"+item.description+" </div>"+
			"<div class='roomTable' id='tmpRoom"+item.id+"'>"+
			"div> class='roomTotal'>Total: </div>"+
		"</div>"	
	}
	
	return roomItem;
	
}

/**
 * Genera una tabla con la informacion de cada habitacion
 * tal como cantidad, precio, num de personas etc.
 * @param reserveInfo
 * @param rooms
 */
function loadRoomInfo(reserveInfo,rooms,roomsFree){	
	
	for(var i=0; i<rooms.length; i++){
		var room = rooms[i];
		$.extend(room,reserveInfo);
		$.extend(room,roomsFree);
		var extraPeople = findExra(room.capacity*1);
		$.extend(room,extraPeople);		
		$("#tmpRoom"+rooms[i].id).setTemplate(getRoomTemplate());
		$("#tmpRoom"+rooms[i].id).setParam('numberFormatter', numberFormatter);
		//el metodo $.processTempate solo acepta parametros arrays
		$("#tmpRoom"+rooms[i].id).processTemplate([room]);	
		$('td:nth-child(1),th:nth-child(1)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(2),th:nth-child(2)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(3),th:nth-child(3)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(4),th:nth-child(4)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(5),th:nth-child(5)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(6),th:nth-child(6)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(7),th:nth-child(7)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(8),th:nth-child(8)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(9),th:nth-child(9)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(10),th:nth-child(10)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(11),th:nth-child(11)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(12),th:nth-child(12)',"#tmpRoom"+rooms[i].id).hide();	
		$('td:nth-child(13),th:nth-child(13)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(14),th:nth-child(14)',"#tmpRoom"+rooms[i].id).hide();
		$('td:nth-child(15),th:nth-child(15)',"#tmpRoom"+rooms[i].id).hide();	
		atachTableEvents("#tmpRoom"+rooms[i].id,rooms[i].nRooms,rooms[i].available*1);
		if (rooms[i].available < 1)
			$("#tmpRoom"+rooms[i].id).append("<div class='notAvailable' >Sin disponibilidad</div>");
		else
			$("#tmpRoom"+rooms[i].id).append("<div class='tRoomPrice' >Total: $ 0.00 "+CURRENCY+"</div><div class='xtraPerson'></div>");
				
	}	
}


/**
 * Plantilla para genera la tabla dinamica
 * @returns {String}
 */
function getRoomTemplate(){
	var room =
	"<table class='tableRooms'>"+	
	 	"{#foreach $T as row}"+ 
    	"<tr>" +
    		"<th> Room Type Id	</th>"+
    		"<th> regualrPrice	</th>"+
    		"<th> Price Type Id	</th>"+
    		"<th> price			</th>"+
    		"<th> pAultExtra	</th>"+
    		"<th> pChildExtra	</th>"+
			"<th> priceType		</th>"+
			"<th> priceTypeName	</th>"+
    		"<th> available		</th>"+
    		"<th> capacity		</th>"+    		
    		"<th> adults		</th>"+    		
    		"<th> children		</th>"+
    		"<th> adultsExtra	</th>"+    		
    		"<th> childrenExtra	</th>"+
    		"<th> roomChange	</th>"+
    		"<th> Rooms  </th>"+
        	"<th> Adults		</th>"+
        	"<th> Childrens	</th>"+
        	"<th> Price by room [{$T.row.capacity} persons] </th>"+
        	"<th> Additional		</th>"+        	
        	"<th></th>"+
        "</tr>"+	    
	      	"<tr>"+
	      		"<td class='hiden roomId'>{$T.row.id}</td>"+
	      		"<td class='hiden regularPrice'>	{$T.row.regularPrice}	</td>"+
	      		"<td class='hiden priceTypeId'>		{$T.row.priceTypeId}	</td>"+
	      		"<td class='hiden price'>			{$T.row.price}			</td>"+
	      		"<td class='hiden pAdultExtra'>		{$T.row.pAdultExtra}	</td>"+
	      		"<td class='hiden pChildExtra'>		{$T.row.pChildExtra}	</td>"+
	      		"<td class='hiden priceType'>		{$T.row.priceType}		</td>"+
	      		"<td class='hiden priceTypeName'>	{$T.row.priceTypeName}	</td>"+
	      		"<td class='hiden available'>		{$T.row.available}		</td>"+
	      		"<td class='hiden capacity'>		{$T.row.capacity}		</td>"+
	      		"<td class='hiden adults'>			{$T.row.nAdults}		</td>"+
	      		"<td class='hiden children'>		{$T.row.nChildren}		</td>"+
	      		"<td class='hiden nAdultExtra'>		{$T.row.nAdultExtra}	</td>"+
	      		"<td class='hiden nChildExtra'>		{$T.row.nChildExtra}	</td>"+
	      		"<td class='hiden roomChange'>0</td>"+	
	      	    "<td class='alt colRooms'>			<input type='text' class='numRooms' name='numRooms' value='{$T.row.nRooms}' size='3' maxlength='3' /> </td>"+
	       	 	"<td class='alt nAdults'>			{$T.row.nAdults}		</td>"+
	       	 	"<td class='alt nChildren'>			{$T.row.nChildren}		</td>"+       
	       	 	"<td class='alt totalPrice'>		{#if $T.row.priceType == 3} <div class='holaMundo'> {'Price: ' +  $P.numberFormatter($T.row.price)} </div> {#else} {'</div>' + $T.row.priceTypeName + ': <span>' + $P.numberFormatter($T.row.price) + '</span> </div>' + '<div class=prevPrice>Regular Price: ' +  $P.numberFormatter($T.row.regularPrice) + '<div>' }  {#/if} </td>"+
	       	 	"<td class='alt'>					<div>Adult: {$P.numberFormatter($T.row.pAdultExtra)}</div> <div> Child: {$P.numberFormatter($T.row.pChildExtra)}</div> </td>"+
	       	 	"<td class='alt colSelect'>			 <input type='checkbox' name='selectRow' {#if $T.row.available < 1} disabled='disabled'   />  </td>"+
	        "</tr>"+
	    "{#/for}"+
    "</table>";
	
	return room;
}


function atachTableEvents(tableWrapper,roomsSelected,maxRooms){
	
	//Selecciona la tabla al seleecionar la casilla de verificacione
	var allCheckBoxSel = $(".colSelect",tableWrapper);
	for(var i=0; i<allCheckBoxSel.length; i++){
		var inputs = $(allCheckBoxSel[i]).children();
		for(var j=0; j<inputs.length; j++){
			$(inputs[j]).unbind();
			$(inputs[j]).bind("change",function(){
				
				if($(this).is(":checked")){				
					$(tableWrapper).find("table").addClass('roomSelected');
					updateRoomValues(tableWrapper,$(".numRooms",tableWrapper).val());
					updateXtraValue(tableWrapper);
					updateTotalValue(tableWrapper);	
				}else{
					$(tableWrapper).find("table").removeClass('roomSelected');									
					$(tableWrapper).find(".tRoomPrice").html(function(){
						return "<div>Total: "+(numberFormatter(0)) +" "+CURRENCY+"</div>";	
					});
					updateXtraValue(tableWrapper);
					updateTotalValue(tableWrapper);	
				}			
			});		
		}		
	}
	
	//Limita el input a valores numericos
	var allCol = $(tableWrapper).find(".colRooms");	
	for(var i=0; i<allCol.length; i++){
		var inputs = $(allCol[i]).children();
		for(var j=0; j<inputs.length; j++){
			var minValue = 1;
			if(maxRooms == 0) minValue = 0;
			$(inputs[j]).SpinnerControl({
				typedata: { min: minValue, max: maxRooms, interval: 1 },
				defaultVal: (roomsSelected*1),
				//Evento al incrementar
				onIncrement: function(value){
					var row = getRowData(tableWrapper);
					if(row.roomChange == 0){					
						$("table .adults",tableWrapper).html(row.capacity * (value-1));	
						$("table .children",tableWrapper).html("0");
						$("table .roomChange",tableWrapper).html("1");						
					}
					
					if(!$("table",tableWrapper).hasClass('roomSelected')){
						$("table",tableWrapper).addClass('roomSelected');
						$("table",tableWrapper).find("input[name=selectRow]").get(0).checked = true;
					}
					
					updateRoomValues(tableWrapper,value);
					updateXtraValue(tableWrapper);
					updateTotalValue(tableWrapper);
				},
				//Eventto al decrement
				onDecrement: function(value){
					var row = getRowData(tableWrapper);
					if(row.roomChange == 0){						
						$("table .adults",tableWrapper).html(row.capacity * (value-1));	
						$("table .children",tableWrapper).html("0");
						$("table .roomChange",tableWrapper).html("1");						
					}
					if(!$("table",tableWrapper).hasClass('roomSelected')){
						$("table",tableWrapper).addClass('roomSelected');	
						$("table",tableWrapper).find("input[name=selectRow]").get(0).checked = true;					
					}
					updateRoomValues(tableWrapper,value);
					updateXtraValue(tableWrapper);
					updateTotalValue(tableWrapper);
				}
			});	
		}		
	}	
}

/**
 * Obiene los valores almacenados en una tabla
 * y los retorna como objeto
 * @param tableWrapper
 * @returns json
 */
function getRowData(tableWrapper){
	var row = {
			roomId			: $(tableWrapper).parent().find(".roomId").html()*1,
			description		: $(tableWrapper).parent().find(".roomDescription").html(),
			regularPrice	: $.trim($(tableWrapper).find(".regularPrice").html())*1,
			priceTypeId		: $.trim($(tableWrapper).find(".priceTypeId").html())*1,
			price			: $.trim($(tableWrapper).find(".price").html())*1,
			pAdultExtra		: $.trim($(tableWrapper).find(".pAdultExtra").html())*1,
			pChildExtra		: $.trim($(tableWrapper).find(".pChildExtra").html())*1,
			priceType		: $.trim($(tableWrapper).find(".priceType").html())*1,
			priceTypeName	: $.trim($(tableWrapper).find(".priceTypeName").html()),
			available		: $.trim($(tableWrapper).find(".available").html())*1,
			capacity		: $.trim($(tableWrapper).find(".capacity").html())*1,
			adults			: $.trim($(tableWrapper).find(".adults").html())*1,
			children		: $.trim($(tableWrapper).find(".children").html())*1,
			nAdultExtra	: $.trim($(tableWrapper).find(".nAdultExtra").html())*1,
			nChildExtra		: $.trim($(tableWrapper).find(".nChildExtra").html())*1,
			roomChange		: $.trim($(tableWrapper).find(".roomChange").html())*1,			
			nRooms			: $.trim($(tableWrapper).find(".numRooms").val())*1,
			totalPrice		: ($.trim($(tableWrapper).find(".numRooms").val()) * $.trim($(tableWrapper).find(".price").html()))*1,
			roomTypeName	: $(tableWrapper).siblings(".roomTypeName").html(),
			days			: getDiferenceDays($("#arriveDate").datepicker("getDate"),$("#departureDate").datepicker("getDate"))
	}
	
	return row;	
}

function updateXtraValue(tableWrapper){
	var adultoTotal = 0; 
	var ninoTotal = 0;
	var legendXtra = '';
	var capacidadTotal = 0;
	var firstPosc = 0;
	var row = getRowData(tableWrapper);
	$(".xtraPerson").html(legendXtra);
	
	for(var dataPosc in arrayPrice){
		var rowTemp = getRowData(dataPosc);
		if($(dataPosc).find(".tableRooms").hasClass("roomSelected")){
			// Capacidad
			capacidadTotal += (row.capacity*$(".numRooms",dataPosc).val());
			// Total reset
			var totalPrice = (rowTemp.price * $(".numRooms",dataPosc).val() * rowTemp.days);
			$(dataPosc).find(".tRoomPrice").html(function(){
				return "<div>Total: "+(numberFormatter(totalPrice)) +" "+CURRENCY+"</div>";	
			});
			arrayPrice[dataPosc] = totalPrice;
		}
	}
	
	if ((capacidadTotal > 0) && (capacidadTotal < (adultoXtra + ninoXtra))){
		if(capacidadTotal <= adultoXtra){
			adultoTotal =  adultoXtra - capacidadTotal;
			ninoTotal = ninoXtra;
		}else{
			adultoTotal = 0;
			ninoTotal = (adultoXtra + ninoXtra) - capacidadTotal; 
		}
		if (adultoTotal>0)
			legendXtra = 'Additional Adult: '+adultoTotal;
		if (adultoTotal>0 && ninoTotal>0)
			legendXtra += '<br/>';
		if (ninoTotal>0)
			legendXtra += 'Additional Child: '+ninoTotal;
			
		for(var dataPosc in arrayPrice){
			var rowTemp = getRowData(dataPosc);
			if($(dataPosc).find(".tableRooms").hasClass("roomSelected")){
				var totalPrice = (rowTemp.price * $(".numRooms",dataPosc).val() * rowTemp.days) + (rowTemp.pAdultExtra * adultoTotal) + (rowTemp.pChildExtra * ninoTotal);
				$(dataPosc).find(".tRoomPrice").html(function(){
					return "<div>Total: "+(numberFormatter(totalPrice)) +" "+CURRENCY+"</div>";	
				});
				arrayPrice[dataPosc] = totalPrice;
				$(dataPosc).find(".xtraPerson").html(legendXtra);
				break;
			}
		}
	}
	
}

/**
 * Actualiza los valores de un tipos habitacion
 * @param tableWrapper
 * @param rooms
 */
function updateRoomValues(tableWrapper,rooms){
	var row = getRowData(tableWrapper);
	var totalPrice = (row.price * rooms * row.days);
	$(tableWrapper).find(".tRoomPrice").html(function(){
		return "<div>Total: "+(numberFormatter(totalPrice)) +" "+CURRENCY+"</div>";	
	});
	arrayPrice[tableWrapper] = totalPrice;
}

function updateTotalValue(tableWrapper){
	
	var total = 0;
	var allTables = $("div[id^='tmpRoom']");
	for(var dataPosc in arrayPrice){
		if($(dataPosc).find(".tableRooms").hasClass("roomSelected"))
			total += arrayPrice[dataPosc];
	}
	
	$("#reserveTotal").data("total",total);
	$("#reserveTotal").html("Total: "+numberFormatter(total) +" "+CURRENCY);
}

/****************************************************************************************************************/
/** Panel 3*/
/****************************************************************************************************************/

function loadPanel3(){
	//
}

function getCustomerInfo(){	
	return {
		'name'		: $.trim($("#cName").val()),
		'aPaterno'	: $.trim($("#cPaterno").val()),
		'aMaterno'	: $.trim($("#cMaterno").val()),
		'address'	: $.trim($("#cAddress").val()),
		'city'		: $.trim($("#cCiyt").val()),
		'state'		: $.trim($("#cState").val()),
		'zip'		: $.trim($("#cZip").val()),
		'country'	: $("#cCountry").val(),
		'phone'		: $.trim($("#cPhone").val()),
		'email'		: $.trim($("#cEmail").val())		
	};
}

/****************************************************************************************************************/
/** Panel 4*/
/****************************************************************************************************************/
var roomReserve = [];

function loadPanel4(){
	
	$("#formPaypal").hide();
	roomReserve = getAllRoomSelected();
	preReserve = getDataPanel1();	
	
	loadReserveSummary();	
}

/**
 * 
 * @param roomReserve
 * @returns {Array}
 */
function getXrefRoomReserve(roomReserve){
	var xref = [];	
	for(var i=0;i<roomReserve.length;i++){
		xref.push({
			'roomId'		: roomReserve[i].roomId,
			'price'			: roomReserve[i].newPrice,
			'quantity'		: roomReserve[i].nRooms,
			'priceType'		: roomReserve[i].priceType,
			'priceTypeId'	: roomReserve[i].priceTypeId
					
		});				
	}	
	return xref;
}

function loadReserveSummary(){
	
	var p1 = getDataPanel1();
	$("#generalData").html(
			"<span class='titleArrive'>Arrival:</span> <span class='txtArrive'>"+p1.strArriveDate +"</span>"+
			"<br/><span class='titleDeparture'>Departure: </span> <span class='txtDeparture'>"+p1.strDepartureDate+"</span>"
	);
	
	var subtotal = getReservePrice(roomReserve);
	var serviceFee = subtotal * .03;
	var roomTax = subtotal * .07;
	var total = subtotal + serviceFee + roomTax;
	
	$("#subTotal").html("Sub-Total: " + numberFormatter(subtotal) +" "+CURRENCY);
	$("#serviceFee").html("Service Fee: " + numberFormatter(serviceFee) +" "+CURRENCY);
	$("#roomTax").html("Room Tax: " + numberFormatter(roomTax) +" "+CURRENCY);
	$("#reservePrice").html("Total: " + numberFormatter(total) +" "+CURRENCY);
	$("#reserveCode").html("Cod. de Reservation: - - - -");
	
	var innerHtml = "";
	var total = 0;
	for(var i=0; i<roomReserve.length; i++){		
		innerHtml += "" +
		"<div class='roomForPay'>"+
			"<div class='roomTypeName sumRoom'>"+roomReserve[i].nRooms+" rooms. "+roomReserve[i].roomTypeName+"</div>" +
			"<div class='roomTypeName sumPrice'>"+numberFormatter(roomReserve[i].newPrice)+"*</div>"+
			"<div class='roomDescription sumDesc'>"+roomReserve[i].description+"</div>"+
		"</div>";
	}
	
	$("#roomSummary").html("<br/><br/>"+innerHtml);	
}


/**
 * Obtiene un arreglo de objetos de todos los tipos de habitacion seleccionado
 */
function getAllRoomSelected(){
	
	var allRooms = $("div[id^='tmpRoom']");	
	var rooms = [];
	var i=0;
	for(var dataPosc in arrayPrice){
		if($(dataPosc).find(".tableRooms").hasClass("roomSelected")){
			var objToReserve = getRowData($(dataPosc));
			objToReserve.newPrice = arrayPrice[dataPosc];
			rooms.push(objToReserve);
		}
		i++;
	}
	
	return rooms;
}

function getReservePrice(rooms){
	
	var price = 0;
	for(var dataPosc in arrayPrice){
		if($(dataPosc).find(".tableRooms").hasClass("roomSelected"))
			price += arrayPrice[dataPosc];
	}	
	return price;	
}


function generateReserve(){
	
	var reserved = $("#reserved").val()*1;
	$("#newReserve").remove();
	
	if(reserved == 0){
		
		$(".anythingWindow").block(blockStyle);	
		$.post(window.preLocation + "reserveController/saveReserve",{
			
				'customer'		: $.toJSON(getCustomerInfo()),
				'xrefRooms'		: $.toJSON(getXrefRoomReserve(roomReserve)),
				'arriveDate'	: preReserve.arriveDate,
				'departureDate' : preReserve.departureDate
				
			},function(jsonData){
				
				var reserveCode = jsonData.code;
				var reserveId =   jsonData.reserveId;
				
				$("#reserved").val(1);
				$("#reserveCode").css({fontWeight:'bold'})
				$("#reserveCode").html("Cod. de Reservation: <span style='color:red'># "+reserveCode+"</div>");
				addPayPalInfo(reserveCode);
				
				$("#nextIcon4").fadeOut(300,function(){
					$("#formPaypal").fadeIn(300);
				});
				
				$(".anythingWindow").unblock();		
				
			},"json"
		);	
	}
}

function addPayPalInfo(reserveCode){	
	$("#ppItemName").val("Reservation "+roomReserve.length+" room(s)");
	$("#ppItemNumber").val(reserveCode);
	var subtotal = getReservePrice(roomReserve);
	var serviceFee = subtotal * .03;
	var roomTax = subtotal * .07;
	var total = subtotal + serviceFee + roomTax;
	$("#ppAmount").val(numberFormatter(total));	
	$("#doPayPal").show('slow');
}

function toSpanishDate(date){
	var weekday=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	var monthname=["January","February","March","April","May","June","July","August","September","October","November","December"];
	return weekday[date.getDay()]+" "+date.getDate()+" de "+monthname[date.getMonth()]+" de "+date.getFullYear()
}

function cleanAll(){
	$("#arriveDate").val("");
	$("#departureDate").val("");
	$("#formCustomer").data("validator").resetForm();
	$("#formCustomer").each (function(){
		  this.reset();
	});
	$("#reserved").val(0);
}


function getDiferenceDays(date1,date2){
	
	var days = 0;
	if(date1 != null && date2 != null)
		days = (date2.getTime() - date1.getTime()) / (1000*60*60*24);
	return (days == 0)? 1 : (days*1);		
}
