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
              var imageDiv = "<div class='col-xs-9 col-md-6 col-xl-2'><img id='image' class='img-responsive  img-thumbnail'></div>";
              var logoutButton = "<form action='../php/logout.php'>"
                                +"<button type='submit' class='btn btn-info'>Logout</button>"
                                +" </form>";
              var changePasswordButton ="<form action='passwordChange.html'>"
                                        +"<button type='submit' class='btn btn-info mt-2'>Cambia password</button>"
                                        +" </form>";
              if(response.Tipo === "Fornitore"){
                 $("#userInfo > p").last().after("<p>Immagine:</p>"+imageDiv);
                 getSupplierImage("#image");
                 var changeImage = "<form action='#'><button type='submit' id='changeImage' class='btn btn-info mt-2'>Cambia immagine profilo</button></form>";          
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
