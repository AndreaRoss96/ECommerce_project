$(document).ready(function(){
    
        jQuery.ajax({
          type: "POST",
          url: "../script/getLoginProblems.php", 
          dataType: "json",
          success: function (response)
          {
            var txt = "";
            var errorBanner = $(".alert-danger");
            errorBanner.text("");
            $.each(response,function(index,error){
              //alert(error);
              txt = txt + error;
            });
            if(txt.length > 0){
                errorBanner.text(txt);
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