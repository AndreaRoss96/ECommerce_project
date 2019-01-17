function include(file)
{

  var script  = document.createElement('script');
  script.src  = file;
  script.type = 'text/javascript';
  script.defer = true;

  document.getElementsByTagName('head').item(0).appendChild(script);
}
$(document).ready(function(){
    var errorBanner = $(".alert-danger");
    errorBanner.hide();
	$("#registerUser").click(function(event){
        event.preventDefault(event);

		errors = "";
        var password = $("#defaultRegisterFormPassword").val();
        var confermaPassword = $("#defaultRegisterFormPasswordConfirm").val();
        
        if(confermaPassword !== password){
            errors += "Le password non coincidono<br/>"
        }
		if(errors.length > 0)
		{
            $("html,body").animate({scrollTop:0},0);
			errorBanner.html(errors);
            errorBanner.show();
            errorBanner.fadeOut(5000); 
        }
		else
		{
            registrationFormHash();
            $(this).parent().submit();
        }
    });
});

include('../script/forms.js');

