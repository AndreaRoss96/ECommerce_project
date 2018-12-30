$(document).ready(function() {
	
	/*quando clicco sul bottone con id = #btnInsertIngredient, creo un nuovo elemento con il testo dell'input text con id = #defaultIngredientFood
	  e lo aggiungo alla list-group.
	*/
	/*
	$("#btnInsertIngredient").click(function () {
		var cl = "py-1 list-group-item list-group-item-action";
		var newEl = $('<a id="item-list-group"></a>').addClass(cl).text($("#defaultIngredientFood").val());
		$(".list-group").append(newEl);
	});
	*/
	/*
		vado ad agganciare un evento click su un elemento che ancora non è stato creato, semplicemente restituisce il testo dell'elemento nella list group
		e lo mette all'interno della input text con id = #defaultIngredientFood.
	*/
	$("body").on('click', '.list-group-item', function () {
		var textTag = $(this).text() + ";";
		if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			$("#list-group-tags").children("input").val(function (i,val) {
				return val.replace(textTag, "");
			});
		} else {
			$(this).addClass("active");
			$("#list-group-tags").children("input").val(function(i, val) {
				return val + textTag;
			});
		}
		console.log($("#list-group-tags").children("input").val());
	});
	
	
});