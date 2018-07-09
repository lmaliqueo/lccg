/* global $ */
/* this is an example for validation and change events */
$.fn.numericInputExample = function () {
	'use strict';
	var element = $(this),
		footer = element.find('tfoot tr'),
		dataRows = element.find('tbody tr'),
		prom_final = document.getElementById("prom_final"),
		/*
		prom = function(value){
			var t =  Number(value.toString().match(/^\d+(?:\.\d{0,3})?/));
			t = Math.round(t*100)/100;
			// console.log( "prom:: "+ t + " -> " +  (Math.round(t*100)/100) );
			t = Math.round(t*10)/10;
			if( t.toString().length == "1" ){
				t = t + ".0";
			}
			return t;
		},*/
		initialTotal = function () {
			var column, total, a, count,count_final = 0, p_final = 0;
			// se recorren todas las filas
			dataRows.each(function () {
				total = 0;
				count = 0;
				var retirado = 0;
				var row = $(this);	// row = fila actual
				 if(	row.children().eq(1).css('color') == 'rgb(255, 0, 0)' ){
				 	retirado = 1
				 }
				for (column = 2; column < row.children().length-1; column++) {  // size()-1 para no contar el ultimo y  parte del 2 por el nombre y  id de notas de alumno
						if( !isNaN(parseFloat(row.children().eq(column).text()))){
							total += parseFloat(row.children().eq(column).text()); // eq = posicion en la fila
							count++;
						}
				};
				total = total/(count); // total-2 por el nombre, id notas. ademas parte en 0, por eso no  se resta el promedio
				if(isNaN(total) || total == 0 || retirado == 1){
					total = " ";
					row.children().eq(column).text(total);
				} else{
					/*
					var p =	prom(total);
					row.children().eq(column).text(p); // se guarda el promedio en la ultima columna de la fila ////

					count_final++;
					p_final += parseFloat(p);*/

				}
			});
			p_final = p_final/(count_final);
			//prom_final.innerHTML = prom(p_final); // promedio asignatura


		};
	element.find('td').on('change', function (evt) {
		var cell = $(this),
			column = cell.index(),
			row,count_final = 0, p_final = 0,
			total = 0,
			count = 0;
		if (column === 0) {
			return;
		}
		element.find('tbody tr').each(function () {
			row = $(this);
			total = 0;
			count = 0;

			for (column = 2; column < row.children().length-1; column++) {  // size()-1 para no cantar el ultimo
					if( !isNaN(parseFloat(row.children().eq(column).text()))){
						total += parseFloat(row.children().eq(column).text()); // eq = posicion en la fila
						count++;
					}
			};

			total = total/(count);

			if (total > 7.0) {  // aka esta el total permitido
				 $('.alert').show();
				 return false;  // changes can be rejected
			} else {
				$('.alert').hide();
				if(isNaN(total) || total == 0){
					total = " ";
					row.children().eq(column).text(total);
				} else{
					/*
					var p = prom(total);
					row.children().eq(column).text(p);

					count_final++;
					p_final += parseFloat(p);*/
				}

			}
		});

		p_final = p_final/(count_final);
		//prom_final.innerHTML = prom(p_final);

	}).on('validate', function (evt, value) {
		var cell = $(this),
			column = cell.index();
		if (column === 0) {
			return !!value && value.trim().length > 0;
		} else {
			if( value == "" ) return true;
			if(!isNaN(parseFloat(value)) && isFinite(value) && value.length <= 2){
				if(value.indexOf(".") == -1  ){
					if( value <= 70 && value >= 1){  // antes de preguntar su valor, me aseguro  que es un numero
						if( value < 10 && value > 7 ){
							return false;
						} else{
							if(  value.charAt( 0 ) == '0'){
								return false;
							}else{
								return true;
							}
						}

					}else{
						return false;
					}
				}else {
					return false;
				}
			} else {
				return false; }
		}
	});
	initialTotal();
	return this;
};
