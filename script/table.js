$(document).ready(function () {
	var table = document.getElementById('foodTable');
	var i = 0;
	var j = 0;
	var elems = 0;
	$("#foodTable").on("click", "tr", function(e) {
		if ($(this).hasClass("bg-info")) {
			//rimuovo la classe highlight dall'elemento selezionato.
			$(this).removeClass("bg-info");
			}
			else {
			//rimuovo la classe highlight da tutti gli elementi
			$(this).siblings().removeClass("bg-info");
			//aggiungo la classe highlight all'elemento selezionato.
			$(this).addClass("bg-info");
			$(".list-group").children("#defaultTagFood").each(function() {
				$(this).removeClass('active');
				var textTag = $(this).attr('value') + ";";
				$("#list-group-tags").children("input").val(function (index, val) {
					return val.replace(textTag, "");
				});
			});
			
			var tagText = $(this).find('td').eq(2).text().split(';');
			tagText.pop();
			document.getElementById('defaultFoodName').value = $(this).find('td').eq(0).text();
			document.getElementById('defaultFoodOldName').value = $(this).find('td').eq(0).text();
			document.getElementById('defaultIngredientsFood').value = $(this).find('td').eq(1).text();
			$(".list-group").children("#defaultTagFood").each(function () {
				for (i=0; i <= tagText.length; i++) {
					if ($(this).text() == tagText[i]) {
						console.log("entrato" + i);
						$(this).addClass('active');
						var textTag = $(this).attr('value') + ";";
						$("#list-group-tags").children("input").val(function (index, val) {
							return val + textTag;
						});
					}
				}
			});
			document.getElementById('defaultPriceFood').value = $(this).find('td').eq(3).text();
		}
	});
});

