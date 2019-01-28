function getOrders(){
    jQuery.ajax({
        type: "POST",
        url: "../php/getOrders.php",
        cache : false,
        data: {
            "getOrders" : true
        },
        dataType: "json",
        success: function (response)  // this is the response from  url: "query.php",
        { 
            $("tbody > tr").remove();
            var newEl="";
            oldID = -1;
            finishEl = "";
            $.each(response, function(index,jsonObject) {
                if (oldID !== jsonObject.id) {
                    oldID = jsonObject.id;
                    newEl += finishEl + "<tr>";
                    newEl += "<td class = 'idOrdine'>" + jsonObject.id + "</td>";
                    newEl += " <td>" + jsonObject.nome + ' x <span class="badge badge-info badge-pill">' + jsonObject.quantita + "</span>";
                    //newEl += "<td>" + jsonObject.nome +  + jsonObject.quantita ;
                    finishEl = "</td>" + "<td>" + jsonObject.luogo + "</td>" + "<td>" + jsonObject.orarioConsegna + "</td>" + "<td>";
                    if(jsonObject.inConsegna == 0){
                        finishEl += "<button type='button'class='btn btn-warning fa fa-arrow-right' title='Evadi ordine'></button>"+"</td></tr>"; 
                    }
                    else{
                        finishEl+= "Evaso" + "</td></tr>";
                    }
                    
                } else {
                    newEl += " <br/>" + jsonObject.nome + ' x <span class="badge badge-info badge-pill">' + jsonObject.quantita + "</span>"; 
                }
            });
            newEl += finishEl;
            $("tbody").append(newEl);
            $("th").addClass("text-center");
            $("td").addClass("text-center");
        
        },
        complete: function() {
            setTimeout(getOrders, 3000);
        },
        error:function (xhr, ajaxOptions, thrownError)
        {
            $("div.table-responsive").remove();
            $("#nothingtoshow").remove();
        // $("p").remove();
            $("div#nav").after().append("<p id='nothingtoshow'>Nessun ordine da mostrare</p>");
        }
 });
}
$(document).ready(function(){    
    getOrders();
    $(".btn-warning").off();
    $(document).on("click",".btn-warning",function(){
        var idOrder = $(this).parent().siblings(".idOrdine").text();
        var button = $(this);
        var buttonContent = button.html();
        if(confirm("Confermi l'evasione di questo ordine?")){
            jQuery.ajax({
                type: "POST",
                url: "../php/getOrders.php", 
                cache : false,
                data: {
                    "sendOrder" : true,
                    "idOrder" : idOrder,
                },
                dataType: "text",
                beforeSend: function(){
                    button.parent().append("<div id='preloader'>"+
                                "<img src='../res/adminPanelPreloader.gif'><\img>"+
                                " <\div>");
                    button.remove();
                },
                success: function (response)
                {  // $("#preloader").before().html(buttonContent);
                    //alert(response);
                    $("#preloader").remove();
                },
            
                error:function (xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
        
            }
            });
        }
    });
  
});


  

