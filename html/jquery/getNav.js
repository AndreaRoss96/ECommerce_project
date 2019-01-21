$(document).ready(function(){
      $("#nav").load("../html/jquery/nav.html",function(){
        $("#userButton").empty().append("<i class='fa fa-user fa-2x' title='Login'></i> Login");
        $("#cartButton").append("Carrello <i class='fa fa-shopping-cart fa-2x' title='Carrello'></i>");
      });
        jQuery.ajax({
          type: "POST",
          url: "../php/loginInformations.php",
          dataType: "json",
          success: function (response)
          {
            var userInfoCollapse = "<div class='collapse' id='userInfoCollapse'>"
                                    +"<div id='userInfo' class='card card-body'>";

                                    console.log("la madonna è piena di letame user");
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
                                        +"<button type='submit' class='btn btn-info mt-2'>Cambia password</button>"
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
      //
      // jQuery.ajax({
      //   url: "../php/cartInformation.php",
      //   dataType: "json",
      //   success: function(response) {
      //
      //     console.log("A gesù puzzano i piedi cart");
      //
      //     var cartInfoCollapse = "<div class='collapse' id='cartInfoCollapse'>"+
      //                               "<table class='table'>"+
      //                                 "<thead> <tr>"+
      //                                     "<th> Prodotto </th>"+
      //                                     "<th> Prezzo </th>"+
      //                                     "<th> Quantità </th>"+
      //                                     "<th> Totale Prodotto </th>"+
      //                                     "<th> &nbsp; </th>"+
      //                                   "</tr> </thead>" +
      //                                   "<tbody>";
      //
      //
      //
      //     cartInfoCollapse = cartInfoCollapse + "</tbody>" + "</table>" +"</div>" + "</div>";
      //     $("nav").after(cartInfoCollapse);
      //     var button = $("#cartButton");
      //     button.attr("data-toggle","collapse")
      //     button.attr("href","#cartInfoCollapse");
      //     button.attr("role","button");
      //     button.attr("aria-expanded","false");
      //     button.attr("aria-controls","cartInfoCollapse");
      //   },
      //
      //   error:function (xhr, ajaxOptions, thrownError)  {
      //     console.log("Dio carrozzina per handicappati cart errore");
      //
      //     var cartInfoCollapse = "<div class='collapse' id='cartInfoCollapse'>"+
      //                               "<table class='table'>"+
      //                                 "<thead> <tr>"+
      //                                     "<th> Prodotto </th>"+
      //                                     "<th> Prezzo </th>"+
      //                                     "<th> Quantità </th>"+
      //                                     "<th> Totale Prodotto </th>"+
      //                                     "<th> &nbsp; </th>"+
      //                                   "</tr> </thead>" +
      //                                   "<tbody>";
      //
      //
      //
      //     cartInfoCollapse = cartInfoCollapse + "</tbody>" + "</table>" +"</div>" + "</div>";
      //     $("nav").after(cartInfoCollapse);
      //
      //   var button = $("#cartButton");
      //   button.attr("data-toggle","collapse")
      //   button.attr("href","#cartInfoCollapse");
      //   button.attr("role","button");
      //   button.attr("aria-expanded","false");
      //   button.attr("aria-controls","cartInfoCollapse");
      // }
      // });
});
