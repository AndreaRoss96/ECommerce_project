function include(file)
{

  var script  = document.createElement('script');
  script.src  = file;
  script.type = 'text/javascript';
  script.defer = true;

  document.getElementsByTagName('head').item(0).appendChild(script);
}
function registrationFormHash() {
     
    // Crea un elemento di input che verrà usato come campo di output per la password criptata.
    var p1 = document.createElement("input");
    var p2 = document.createElement("input");
    var form = document.getElementById("form");
    var password = document.getElementById("defaultRegisterFormPassword");
    var confermaPassword = document.getElementById("defaultRegisterFormPasswordConfirm");

    // Aggiungi un nuovo elemento al tuo form.
    form.appendChild(p1);
    p1.name = "p1";
    p1.type = "hidden";
    p1.value = hex_sha512(password.value);
    // Assicurati che la password non venga inviata in chiaro.
   // alert(password.value);
//alert(p1.value);
    password.value = "";
    // Aggiungi un nuovo elemento al tuo form.
    form.appendChild(p2);
    p2.name = "p2";
    p2.type = "hidden"
    p2.value = hex_sha512(confermaPassword.value);
    // Assicurati che la password non venga inviata in chiaro.
    confermaPassword.value = "";
 }

 function loginFormHash(){
     // Crea un elemento di input che verrà usato come campo di output per la password criptata.
     var p1 = document.createElement("input");
     var form = document.getElementById("form");
     var password = document.getElementById("defaultLoginFormPassword");
 
     // Aggiungi un nuovo elemento al tuo form.
     form.appendChild(p1);
     p1.name = "p1";
     p1.type = "hidden"
     p1.value = hex_sha512(password.value);
     // Assicurati che la password non venga inviata in chiaro.
    // alert(password.value);
    // alert(p1.value);
     password.value = "";
 }

 include('../script/sha512.js');



