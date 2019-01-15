$(document).ready(function(){
      $("#nav").load("jquery/nav.html",function(){
        $("#userButton").empty().append("<i class='fa fa-user fa-2x' title='Login'></i> Login");
      });
      jQuery.ajax({
        type: "POST",
        url: "../php/loginInformations.php", 
        dataType: "json",
        success: function (response)
        { var userInfoCollapse = "<div class='collapse' id='userInfoCollapse'>"
                                  +"<div id='userInfo' class='card card-body'>";
                            
          $.each(response,function(key,val){
             userInfoCollapse = userInfoCollapse + "<p>" + key + " : " + val + "</p>";
          });
                          
            userInfoCollapse = userInfoCollapse +"</div>" + "</div>";
            $("nav").after(userInfoCollapse);
            var button = $("#userButton");
            $("#userButton").empty().append("<i class='fa fa-user fa-2x' title='Login'></i> "+response.Nome+" "+response.Cognome);
            button.removeAttr("href");
            button.attr("data-toggle","collapse")
            button.attr("href","#userInfoCollapse");
            button.attr("role","button");
            button.attr("aria-expanded","false");
            button.attr("aria-controls","userInfoCollapse"); 
            var logoutButton = "<form action='../php/logout.php'>"
                              +"<button type='submit' class='btn btn-info'>Logout</button>"
                              +" </form>";
            var changePasswordButton ="<form action='passwordChange.html'>"
                                      +"<button type='submit' class='btn btn-info'>Cambia password</button>"
                                      +" </form>";
            $("#userInfo > p").last().after(changePasswordButton);
            $("#userInfo > p").last().after(logoutButton);
          //alert(userInfoCollapse);
           
        },
       
        error:function (xhr, ajaxOptions, thrownError)
       {
         var button = $("#userButton");
         button.removeAttr("href");
         button.attr("href","../html/userSupplierLogin.html");
         button.removeAttr("data-toggle","collapse")
         button.removeAttr("role","button");
         button.removeAttr("aria-expanded","false");
         button.removeAttr("aria-controls","userInfoCollapse"); 
       }
    });
});
