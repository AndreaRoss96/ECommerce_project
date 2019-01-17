$(document).ready(function () {
	$(".clickable-row").click(function () {
		var start = new Date().getTime();
		if ($(this).hasClass("bg-info")) {
			//rimuovo la classe highlight dall'elemento selezionato.
			$(this).removeClass("bg-info");
		}
		else {
			//rimuovo la classe highlight da tutti gli elementi
			$(this).siblings().removeClass("bg-info");
			//aggiungo la classe highlight all'elemento selezionato.
			$(this).addClass("bg-info");
			var tdEls = $(this).children("td");
			var tags = tdEls.eq(2).text().split(";");
			
			var i = 0;
			var j = 0;
			var headerRow;
			tags.pop();
			$("#list-group-tags").children("input").val("");
			$(".list-group").children().removeClass("active");
			$("#headerRow").children("th").each(function (i) {
				j = 0;
				if (i > 0) {
					headerRow = "#default" + $(this).text().replace(" ","");
					if (headerRow.localeCompare("#defaultTagFood") == 0) {
						while(j < tags.length) {
							console.log(tags[j]);
							$(".list-group").children("#defaultTagFood:contains(" + tags[j].trim() + ")").addClass("active");
							$("#list-group-tags").children("input").val(function(i, val) {
								return val + $(".list-group").children("#defaultTagFood:contains(" + tags[j].trim() + ")").attr('value') + ";";
							});
							j++;
						}
					} else if (headerRow.localeCompare("#defaultFoodName") == 0) {
						$("body").find(headerRow).val(tdEls.eq(i - 1).text());
						$("body").find("#defaultFoodOldName").val(tdEls.eq(i - 1).text());
					} else {
						$("body").find(headerRow).val(tdEls.eq(i - 1).text());
					}
				}
			});
			
		}
		var end = new Date().getTime();
	var time = end - start;
	alert('Execution time: ' + time);
	});
	
});

function inputFill() {
	var table = $("#foodTable");
	for(var i=0; i < table.rows.length; i++) {
		table.rows[i].onclik = function() {
			var tagsText = this.cell[3].innerHTML;
			document.getElementById('defaultFoodName').value = this.cell[1].innerHTML;
			document.getElementById('defaultFoodOldName').value = this.cell[1].innerHTML;
			document.getElementById('defaultIngredientsFood').value = this.cell[2].innerHTML;
			document.getElementById('
		}
		
	}
}