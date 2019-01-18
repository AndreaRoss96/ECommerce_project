$(document).ready(function(){
    $(".alert").hide();
          jQuery.ajax({
            type: "POST",
            url: "../script/getRegistrationProblems.php", 
            dataType: "json",
            success: function (response)
            {
              var txt = "";
              var errorBanner = $(".alert-danger");
              //errorBanner.text("");
              $.each(response,function(index,error){
                txt = txt + error;
              });
              //alert(txt);
              if(txt.length > 0){
                  errorBanner.html(txt);
                  errorBanner.show();
                  errorBanner.fadeOut(7000); 
              }      
                
               
            }, 
            error:function (xhr, ajaxOptions, thrownError)
           {
               alert(thrownError);
           }
        });
           
  });