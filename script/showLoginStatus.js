$(document).ready(function(){
  $(".alert").hide();
     
        jQuery.ajax({
          type: "POST",
          url: "../script/getLoginProblems.php",
          cache : false, 
          dataType: "json",
          success: function (response)
          {
            var txt = "";
            var errorBanner = $(".alert-danger");
            //errorBanner.text("");
            $.each(response,function(index,error){
              //alert(error);
              txt = txt + error;
            });
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
      jQuery.ajax({
        type: "POST",
        url: "../script/getLoginCheck.php", 
        cache : false,
        dataType: "json",
        success: function (response)
        {
          var txt = "";
          var successBanner = $(".alert-success");
          //successBanner.text("");
          $.each(response,function(index,error){
            //alert(error);
            txt = txt + error;
          });
          if(txt.length > 0){
            successBanner.html(txt);
            successBanner.show();
            successBanner.fadeOut(4000); 
          }      
            
          
        }, 
        error:function (xhr, ajaxOptions, thrownError)
      {
          alert(thrownError);
      }
      });
 


  
});