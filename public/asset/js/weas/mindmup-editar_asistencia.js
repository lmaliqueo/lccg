$.fn.editableTableWidget = function (options) {
	'use strict';
	return $(this).each(function () {
		var buildDefaultOptions = function () {
				var opts = $.extend({}, $.fn.editableTableWidget.defaultOptions);
				opts.editor = opts.editor.clone();
				return opts;
			},
			activeOptions = $.extend(buildDefaultOptions(), options),
			ARROW_LEFT = 37, ARROW_UP = 38, ARROW_RIGHT = 39, ARROW_DOWN = 40, ENTER = 13, ESC = 27, TAB = 9,
			element = $(this),
			editor = activeOptions.editor.css('position', 'absolute').hide().appendTo(element.parent()),
			active,
			showEditor = function (select) {
				active = element.find('td:focus');
				if (active.length) {
					editor.val(active.text().toUpperCase())
						.removeClass('error')
						.show()
						.offset(active.offset())
						.css(active.css(activeOptions.cloneProperties))
						.width(active.width())
						.height(active.height())
						.focus();
					if (select) {
						editor.select();
					}
				}
			},
			setActiveText = function () {
				if( editor.val().toUpperCase() == "NE" ){
					editor.val("N/E");
				}
				var text = editor.val().toUpperCase(),
					evt = $.Event('change'),
					originalContent;
				if (active.text() === text || editor.hasClass('error')) {
					return true;
				}
				originalContent = active.html();
				active.text(text).trigger(evt, text);
				if (evt.result === false) {
					active.html(originalContent);
				}
			},
			movement = function (element, keycode) {
				if (keycode === ARROW_RIGHT) {
					return element.next('td');
				} else if (keycode === ARROW_LEFT) {
					return element.prev('td');
				} else if (keycode === ARROW_UP) {
					return element.parent().prev().children().eq(element.index());
				} else if (keycode === ARROW_DOWN) {
					return element.parent().next().children().eq(element.index());
				} else if(keycode === "inicio"){
					return element.parent().next().children().eq(1);
				} else if(keycode === "inicio_arriba"){
					var index = element.index();
					return element.parent().siblings(":first").children().eq(index +1 );
				}

				return [];
			};
		editor.blur(function () {
			setActiveText();
			editor.hide();
		}).keydown(function (e) {
			var numero_cells = active.parent().children().length-3; 
			var numero_rows = active.parent().parent().children().length;

			if (e.which === ENTER) {
				var index = active.parent().index();
				setActiveText();
				editor.hide();
				active.focus();
				e.preventDefault();
				e.stopPropagation();
				var possibleMove = movement(active,ARROW_DOWN);
				var index = possibleMove.parent().index();
				
					if(index  == -1){ // pregunto  si es el ultimo en lA FILA
						movement(active,"inicio_arriba").focus();
					}else{
						possibleMove.focus();
						e.preventDefault();
						e.stopPropagation();
					}

					// console.log("row: " + index);
					// console.log(numero_rows);
				
			} else if (e.which === ESC) {
				editor.val(active.text());
				active.focus();
				e.preventDefault();
				e.stopPropagation();
				editor.hide();
				
			}else if (this.selectionEnd - this.selectionStart === this.value.length) {
				var possibleMove = movement(active, e.which);
				if (possibleMove.length > 0) {
					possibleMove.focus();
					e.preventDefault();
					e.stopPropagation();
				}
			} else if (e.which === ARROW_RIGHT) {
					var possibleMove = movement(active,ARROW_RIGHT);
			}



		})
		.on('input paste', function () {
			var evt = $.Event('validate');
			active.trigger(evt, editor.val());
			if (evt.result === false) {
				editor.addClass('error');
			} else {
				editor.removeClass('error');
			}
		});
		element.find("td:not([data-editable='false'])").on('click keypress dblclick', showEditor)
		.css('cursor', 'pointer')
		.keydown(function (e) {
			var prevent = true,
				possibleMove = movement($(e.target), e.which);
			if (possibleMove.length > 0) {
				possibleMove.focus();
			} else if (e.which === ENTER) {
				showEditor(false);
			} else if (e.which === 17 || e.which === 91 || e.which === 93) {
				showEditor(true);
				prevent = false;
			} else {
				prevent = false;
			}
			if (prevent) {
				e.stopPropagation();
				e.preventDefault();
			}
		});

		//element.find("td:not([data-editable='false'])").prop('tabindex', 1);

		$(window).on('resize', function () {
			if (editor.is(':visible')) {
				editor.offset(active.offset())
				.width(active.width())
				.height(active.height());
			}
		});
	});

};
$.fn.editableTableWidget.defaultOptions = {
	cloneProperties: ['padding', 'padding-top', 'padding-bottom', 'padding-left', 'padding-right',
					  'text-align', 'font', 'font-size', 'font-family', 'font-weight',
					  'border', 'border-top', 'border-bottom', 'border-left', 'border-right'],
	editor: $('<input>')
};
