function getMessages(){
    jQuery.ajax({
        type: "POST",
        url: "../php/getMessages.php",
        cache : false,
        data:{
            getMessages:true
        },
        dataType: "json",
        success: function (response)  // this is the response from  url: "query.php",
        { 
            $("tbody > tr").remove();
            var newEl="";
            $.each(response, function(index,jsonObject){
            newEl +="<tr>";
                $.each(jsonObject, function(key,val) {
                
                    if(key==="id"){
                        newEl += "<td class='idMessaggio' style='display:none'>"+val+"</td>";
                    }
                    else{
                        if(key === "letto"){
                            if(val == 0){
                                newEl += "<td>"+"<button type='button'class='btn btn-success fa fa-check conferma-lettura' title='Conferma lettura'></button>"+"</td>";
                            }
                            else{
                                newEl += "<td>"+"Letto"+"</td>";
                            }
                        }
                        else{
                            newEl += "<td>"+val+"</td>";
                        }
                    }
                    

                });
                newEl +="</tr>";
            });
            newEl= newEl+"</tr>";
            $("tbody").append(newEl);
            $("th").addClass("text-center");
            $("td").addClass("text-center");
        },
        complete: function() {
            setTimeout(getMessages, 2000);
        },
        error:function (xhr, ajaxOptions, thrownError)
        {  // alert(thrownError);
            $("div.table-responsive").remove();
            $("#nothingtoshow").remove();
            $("div#nav").after().append("<p id='nothingtoshow'>Nessuna notifica da mostrare</p>");
        }
 });
}
$(document).ready(function(){    
    getMessages();
    $(".conferma-lettura").off();
    $(document).on("click",".conferma-lettura",function(){
        var idOrder = $(this).parent().siblings(".idMessaggio").text();
        var button = $(this);
        var buttonContent = button.html();
        if(confirm("Confermi la lettura di questa notifica?")){
            jQuery.ajax({
                type: "POST",
                url: "../php/getMessages.php", 
                cache : false,
                data: {
                    "confirmMessage" : true,
                    "idMessaggio" : idOrder,
                },
                dataType: "text",
                beforeSend: function(){
                    button.parent().append("<div id='preloader'>"+
                                "<img src='../res/adminPanelPreloader.gif'>"+
                                " </div>");
                    button.remove();
                },
                success: function (response)
                {  // $("#preloader").before().html(buttonContent);
                    //alert(response);
                    $("#preloader").remove();
                },
            
                error:function (xhr, ajaxOptions, thrownError)
            {
                //alert(thrownError);
        
            }
            });
        }
    });
  
});


  

