$(document).ready(function(){
  $(".alert").hide();
        $.ajax({
          type: "POST",
          cache : false,
          url: "../script/getLoginProblems.php",
          dataType: "json",
          success: function (response)
          {
            var txt = "";
            var errorBanner = $(".alert-danger");
            $.each(response,function(index,error){
              //alert(error);
              txt = txt + error + "<br/>";
            });
            if(txt.length > 0){
                errorBanner.html(txt);
                errorBanner.show();
                errorBanner.fadeOut(3000); 
            }
            $.ajax({
              type: "POST",
              cache : false,
              url: "../script/getLoginCheck.php", 
              dataType: "json",
              success: function (response)
              {
                var txt = "";
                var successBanner = $(".alert-success");
                $.each(response,function(index,error){
                  //alert(error);
                  txt = txt + error + "<br/>";
                });
                if(txt.length > 0){
                  successBanner.html(txt);
                  successBanner.show();
                  successBanner.fadeOut(2000); 
                }      
                  
                
              }, 
              error:function (xhr, ajaxOptions, thrownError)
            {
                alert(thrownError);
            }
            });      
              
             
          }, 
          error:function (xhr, ajaxOptions, thrownError)
         {
             alert(thrownError);
         }
      });
     
 


  
});