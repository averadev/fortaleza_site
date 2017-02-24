// Extend the default Number object with a formatMoney() method:
// usage: someVar.formatMoney(decimalPlaces, symbol, thousandsSeparator, decimalSeparator)
// defaults: (2, "$", ",", ".")
Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
	places = !isNaN(places = Math.abs(places)) ? places : 2;
	symbol = symbol !== undefined ? symbol : "$ ";
	thousand = thousand || ",";
	decimal = decimal || ".";
	var number = this, 
	    negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
};

Date.prototype.yyyymmdd = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd  = this.getDate().toString();
   return yyyy +'-'+ (mm[1]?mm:"0"+mm[0]) +'-'+ (dd[1]?dd:"0"+dd[0]); // padding
  };

function mostrarFecha(fecha)
{
	var nombres_meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", 
		"Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	
	var dia_mes = fecha.getDate();
	var mes = fecha.getMonth() + 1;
	var anio = fecha.getFullYear();

	return dia_mes + " de " + nombres_meses[mes - 1] + " del " + anio;
}

function getFecha(dateStr){
	var dateA = dateStr.split('-');
	var dateObj = new Date();
	dateObj.setDate(parseInt(dateA[2]));
	dateObj.setMonth(parseInt(dateA[1]) - 1);
	dateObj.setFullYear(parseInt(dateA[0]));
	return dateObj;

}

function changeDate(idCmp, newDate){
	var formatDate = newDate.yyyymmdd();
	$(idCmp).data({date: formatDate});
	$(idCmp).datepicker('update');
	$(idCmp).attr('data-date', formatDate);
	$(idCmp).datepicker().children('input').val(formatDate);

	$($($(idCmp).parent()).children("span")).html(mostrarFecha(newDate));
}
