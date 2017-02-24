
/**
 * Funcion que recarga un jqGrid
 * 
 * @param gridConteniner	: id del grid
 * @param action 			: accion asociada al grid
 * @param params			: parametros opcionales
 */
jQuery.fn.reloadGrid = function (params){
		
	//Action anterior
	var prevAction = $(this).jqGrid('getGridParam', 'url');
	//Action actual sin parametros
	var action = "";
	//Nuevo action c/s parametros
	var newAction = "";
	
	if(prevAction.indexOf("?")>0)
		action = prevAction.substring(0,prevAction.indexOf("?"));
	else
		action = prevAction;	
	
	var newAction = (params != null) ?  action + '?' + params : action;	
			
	$(this).jqGrid('clearGridData');
	
	$(this).jqGrid('setGridParam', {
		url:newAction,
		datatype: 'json',	    		
	    //rowNum: numRegXPagina,    
	});
	
	$(this).trigger('reloadGrid');
	
	//Reiniciando la URL
	$(this).jqGrid('setGridParam', {
		url:prevAction,
		//datatype: 'json',	    
	   // rowNum: numRegXPagina
	});
};