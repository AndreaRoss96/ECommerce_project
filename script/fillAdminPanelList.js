$(document).ready(function getSuppliers(){

    jQuery.ajax({
        type: "POST",
        url: "../php/adminPanel.php", 
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
                    newEl = newEl+ "<td>"+"<button type='button'class='btn btn-success fa fa-check' title='Approva'></button>"+"</td>"; 
                }
                else{
                    newEl = newEl+"<td>"+"<button type='button'class='btn btn-danger fa fa-remove' title='Disapprova'></button>"+"</td>";
                }
                newEl= newEl+"<td>"+"<button type='button'class='btn btn-dark fa fa-trash' title='Elimina'></button>"+"</td>";
                newEl= newEl+"</tr>";
            });
            $("tbody").append(newEl);
            $("th").addClass("text-center");
            $("td").addClass("text-center");
         
        },
        complete: function() {
            setTimeout(getSuppliers, 5000);
        },
        error:function (xhr, ajaxOptions, thrownError)
       {
        $("div.table-responsive").remove();
        $("p").remove();
        $("div#nav").after().append("<p>Autorizzazioni non sufficienti</p>");
       }
    });
    $(document).off().on("click",".btn-dark",function(){
        var piva = $(this).parent().siblings(".piva").text();
        if(confirm("Sei sicuro di voler eliminare questo fornitore?")){
            jQuery.ajax({
                type: "POST",
                url: "../php/adminPanel.php?removeSupplier", 
                data: {
                    "supplierToRemove" : piva
                },
                dataType: "text",
                success: function (response)
                {   
                    alert(piva+" è stato eliminato con successo");
                },
            
                error:function (xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
        
            }
            });
        }
    });

    $(document).on("click",".btn-danger,.btn-success",function(){
        var piva = $(this).parent().siblings(".piva").text();
        //alert(piva);
        jQuery.ajax({
            type: "POST",
            url: "../php/adminPanel.php?supplierToChange", 
            data: {
                "supplierToChange" : piva
            },
            dataType: "text",
            success: function (response)
            {   
                alert("Modifica eseguita corretamente");
            },
           
            error:function (xhr, ajaxOptions, thrownError)
           {
              alert(thrownError);
    
           }
        });
    });
    
});


  

