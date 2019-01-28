function getSuppliers(){
    jQuery.ajax({
        type: "POST",
        url: "../php/adminPanel.php",
        cache : false,
        data: {
            "getSuppliers" : true
        },
        dataType: "json",
        success: function (response)  // this is the response from  url: "query.php",
        { 
            $("tbody > tr").remove();
            var newEl="";
            var statoApprovazione = 0;
            $.each(response, function(index,jsonObject){
                newEl = newEl+"<tr>";
                $.each(jsonObject, function(key,val){
                    if(key == "approvazioneAmministratore"){
                        statoApprovazione = val;
                        if(statoApprovazione == 0){
                            val = "Non approvato";
                        }
                        else{
                            val = "Approvato";
                        }
                    }
                    if(key == "P_IVA"){
                        newEl = newEl+"<td class = 'piva'>";
                    }
                    else{
                        newEl = newEl+"<td>";
                    }
                    newEl = newEl+val+"</td>";
                });
                if(statoApprovazione == 0){
                    newEl = newEl+ "<td>"+"<button type='button'class='btn btn-success fa fa-check approva' title='Approva'></button>"+"</td>"; 
                }
                else{
                    newEl = newEl+"<td>"+"<button type='button'class='btn btn-danger fa fa-remove disapprova' title='Disapprova'></button>"+"</td>";
                }
                newEl= newEl+"<td>"+"<button type='button'class='btn btn-dark fa fa-trash' title='Elimina'></button>"+"</td>";
                newEl= newEl+"</tr>";
            });
            $("tbody").append(newEl);
            $("th").addClass("text-center");
            $("td").addClass("text-center");
        
        },
        complete: function() {
            setTimeout(getSuppliers, 3000);
        },
        error:function (xhr, ajaxOptions, thrownError)
    {
        $("div.table-responsive").remove();
        $("#nothingtoshow").remove();
       // $("p").remove();
        $("div#nav").after().append("<p id='nothingtoshow'>Nessun fornitore da mostrare</p>");
    }
 });
}
$(document).ready(function(){
  
    getSuppliers();
    $(".btn-dark").off();
    /*$(document).off()*/$(document).on("click",".btn-dark",function(){
        var piva = $(this).parent().siblings(".piva").text();
        var button = $(this);
        var buttonContent = button.html();
        if(confirm("Sei sicuro di voler eliminare questo fornitore?")){
            jQuery.ajax({
                type: "POST",
                url: "../php/adminPanel.php?removeSupplier", 
                cache : false,
                data: {
                    "supplierToRemove" : piva
                },
                dataType: "text",
                beforeSend: function(){
                    button.parent().append("<div id='preloader'>"+
                                "<img src='../res/adminPanelPreloader.gif'>"+
                                " </div>");
                    button.remove();
                },
                success: function (response)
                {   $("#preloader").before().html(buttonContent);
                    $("#preloader").remove();
                    alert(piva+" è stato eliminato con successo");
                },
            
                error:function (xhr, ajaxOptions, thrownError)
            {
               // alert(thrownError);
        
            }
            });
        }
    });

    $(document).on("click",".disapprova,.approva",function(){
        var button = $(this);
        var buttonContent = button.html();
        var piva = $(this).parent().siblings(".piva").text();
        //alert(piva);
        jQuery.ajax({
            type: "POST",
            url: "../php/adminPanel.php?supplierToChange", 
            cache : false,
            data: {
                "supplierToChange" : piva
            },
            dataType: "text",
            beforeSend: function(){
                button.parent().append("<div id='preloader'>"+
                            "<img src='../res/adminPanelPreloader.gif'><\img>"+
                            " <\div>");
                button.remove();
            },
            success: function (response)
            {   $("#preloader").before().html(buttonContent);
                $("#preloader").remove();

                alert("Modifica eseguita correttamente");
            },
           
            error:function (xhr, ajaxOptions, thrownError)
           {
             //alert(thrownError);
    
           }
        });
    });   
});


  

