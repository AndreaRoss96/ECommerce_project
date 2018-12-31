$(document).ready(function () {
	$(".clickable-row").click(function () {
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
			$(".list-group").children().removeClass("active");
			$("#headerRow").children("th").each(function (i) {
				j = 0;
				if (i > 0) {
					headerRow = "#default" + $(this).text().replace(" ","");
					if (headerRow.includes("TagFood")) {
						while(j < tags.length) {
							$(".list-group").children("#defaultTagFood:contains(" + tags[j].trim() + ")").addClass("active");
							j++;
						}
					} else {
						$("body").find(headerRow).val(tdEls.eq(i - 1).val());
					}
				}
			});
			
		}
	});
});