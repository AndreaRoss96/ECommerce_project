$(document).ready(function(){
      $("#nav").load("jquery/nav.html");
      jQuery.ajax({
        type: "POST",
        url: "../php/loginInformations.php", 
        dataType: "json",
        success: function (response)  // this is the response from  url: "query.php",
        { var userInfoCollapse = "<div class='collapse' id='userInfoCollapse'>"
                                  +"<div id='userInfo' class='card card-body'>";
                            
          $.each(response,function(key,val){
             userInfoCollapse = userInfoCollapse + "<p>" + key + " : " + val + "</p>";
          });
                          
            userInfoCollapse = userInfoCollapse +"</div>" + "</div>";
            var button = $("#userButton");
            $("nav").after(userInfoCollapse);
            button.removeAttr("href");
            button.attr("data-toggle","collapse")
            button.attr("href","#userInfoCollapse");
            button.attr("role","button");
            button.attr("aria-expanded","false");
            button.attr("aria-controls","userInfoCollapse"); 
            var logoutButton="<form action='../php/logout.php'>"
                              +"<button type='submit' class='btn btn-info'>Logout</button>"
                              +" </form>";
            $("#userInfo > p").last().after(logoutButton);

           
        },
       
        error:function (xhr, ajaxOptions, thrownError)
       {
         //alert(thrownError);
         var button = $("#userButton");
         button.removeAttr("href");
         button.attr("href","login.html");
       }
    });
});
