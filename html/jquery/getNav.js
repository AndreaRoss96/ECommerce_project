function uploadSupplierImage(file){
  if(file){
    reader = new FileReader();
    reader.onload = function(){
      var result = reader.result;
      var output = document.getElementById('image');
      output.src = result;
    }
    reader.readAsDataURL(file);

    var form_data = new FormData();
    form_data.append('file',file);
    jQuery.ajax({
      type: "POST",
      url: "../php/uploadProfileImage.php",
      dataType: "text",
      cache : false,
      contentType : false,
      processData : false,
      data: form_data,
      success: function (response)
      {
        $("#fileChooser").val('');
        alert(response);

      },
      error:function (xhr, ajaxOptions, thrownError)
      {
          alert(thrownError);
      }
    });
  }
}
function getUnreadMessagesCount(){
  jQuery.ajax({
    type: "POST",
    url: "../php/getUnreadMessagesCount.php",
    dataType: "json",
    success: function (response)
    {        
      //alert(response);
      $("#noticesCount").text(response.numeroMessaggiNonLetti);
      //alert(response.numeroMessaggiNonLetti);
     // alert(response.numeroMessaggiNonLetti);
    },
    complete: function(){
      setTimeout(getUnreadMessagesCount,2000);
    }
  });
}
function getSupplierImage(img){
    jQuery.ajax({
      type: "POST",
      url: "../php/getProfileImage.php",
      dataType: "text",
      cache : false,
      contentType : false,
      processData : false,
      success: function (response)
      {
        $("#fileChooser").val('');
        $(img).attr("src",'data:image/jpg;base64,' + response);
       // $(img).src = 'data:image/jpg;base64,' + response;
       // console.log($(img));

      },
      error:function (xhr, ajaxOptions, thrownError)
      {

          alert(thrownError);
      }
    });
}

$(document).ready(function(){
        $("#nav").load("../html/jquery/nav.html",function(){
        $("#userButton").empty().append("<i class='fa fa-user' title='Login'></i> <div class='icontitle' style='display:inline-block'>Login</div>");
        $("#cart").append("<div class='icontitle' style='display:inline-block'>Vai al carrello</div><i class='fa fa-shopping-cart' title='Carrello'></i>");
        $("#cart").hide();
      });
        jQuery.ajax({
          type: "POST",
          url: "../php/loginInformations.php",
          dataType: "json",
          success: function (response)
          {
            var userInfoCollapse = "<div class='collapse' id='userInfoCollapse'>"
                                    +"<div id='userInfo' class='card card-body' style='background-color : #f1f3f4'>";

            $.each(response,function(key,val){
                userInfoCollapse = userInfoCollapse + "<p>" + key + " : " + val + "</p>";
            });

              userInfoCollapse = userInfoCollapse +"</div>" + "</div>";
              $("nav").after(userInfoCollapse);
              var button = $("#userButton");
              $("#userButton").empty().append("<i class='fa fa-user' title='Login'></i> "+"<div class='icontitle' style='display:inline-block'>"+response.Nome+" "+response.Cognome)+"</div>";
              $("#userButton").after("<a href='../html/notices.html'><span id='noticesCount' class='badge badge-primary badge-pill'>0</span></a>");
              button.removeAttr("href");
              button.attr("data-toggle","collapse")
              button.attr("href","#userInfoCollapse");
              button.attr("role","button");
              button.attr("aria-expanded","false");

              button.attr("aria-controls","userInfoCollapse");
              var imageDiv = "<div class='row'><div class='col-xs-9 col-md-6 col-xl-2'><img id='image' class='img-responsive img-thumbnail'></div></div>";
              button.attr("aria-controls","userInfoCollapse");

              var logoutButton = "<form action='../php/logout.php'>"
                                +"<button type='submit' class='btn btn-danger mt-2'>Logout</button>"
                                +" </form>";
              var changePasswordButton ="<form action='../html/passwordChange.html'>"
                                        +"<button type='submit' class='btn btn-warning mt-2'>Cambia password</button>"
                                        +" </form>";
              
              if(response.Tipo === "Cliente"){
                $("#cart").show();
              }
              else if(response.Tipo === "Fornitore"){
                $("#cart").empty().removeAttr("href").attr("href","../html/SupplierOperations.html").append("<div class='icontitle' style='display:inline-block'>Strumenti</div> <i class='fa fa-cog' title='Strumenti'></i>")
                $("#cart").show();
              }
              if(response.Tipo === "Fornitore"){
                 $("#userInfo > p").last().after("<p>Immagine:</p>"+imageDiv);
                 getSupplierImage("#image");
                 var changeImage = "<form action='#'><button type='submit' id='changeImage' class='btn btn-secondary mt-2'>Cambia immagine profilo</button></form>";
                 $("#userInfo > div").last().after(changeImage);
                 var email = response.Email;
                 var fileChooser = "<input type='file' id='fileChooser' accept='image/jpeg' style='display: none' />"
                 $("#userInfo > div").last().after(fileChooser);
                 $("#fileChooser").change(function(){
                   uploadSupplierImage($('#fileChooser').prop("files")[0]);
                 });
                 $("#changeImage").click(function(){
                   $("#fileChooser").trigger("click");
                });
                $("#userInfo > form").last().after(changePasswordButton);
                $("#userInfo > form").last().after(logoutButton);
              }
              else{
                $("#userInfo > p").last().after(changePasswordButton);
                $("#userInfo > p").last().after(logoutButton);
              }
              getUnreadMessagesCount();             
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
        },
        complete : function(){
          var valore = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
          if(valore){
            $(".icontitle").hide();
          }
        }
      });

});
