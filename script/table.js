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
			values = $(this).children("td");
			for(i=0; i < values.length; i++) {
				$("form").find("input").eq(i).val(values.eq(i).text());
			}
		}
		//fillForm();
	});
});