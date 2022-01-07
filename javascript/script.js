const CHECK_PASSWORD = /^[A-Z\d]{1,20}$/i;
const CHECK_USERNAME = /^[A-Z]{1,20}$/i;
const CHECK_EMAIL = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const CHECK_NAME_AND_SURNAME = /^[A-Z ]{2,30}$/i;
const CHECK_CITY = /^[A-Z ]{2,40}$/i;


window.onload = function () {

  if (document.getElementById("loginForm") != null) {
    items = [
      "LUsername",
      "LPassword"
    ];
    items.forEach(function (item) {
      document.getElementById(item).addEventListener("blur", checkLogin);
      document.querySelector('button').addEventListener("blur", checkLogin);
    });
  }

  if (document.getElementById("registerForm") != null) {
      items = [
        "REmail",
        "RUsername",
        "RName",
        "RSurname",
        "RCity",
        "RPassword",
        "RPasswordRepeat"
      ];
      items.forEach(function (item) {
        document.getElementById(item).addEventListener("blur", checkRegister);
        document.querySelector('button').addEventListener("blur", checkRegister);
      });
  }









}

function checkLogin(){
  const button = document.querySelector('button');
  var i = 0;

  var username = document.getElementById("LUsername").value;
  var password = document.getElementById("LPassword").value;

  i += checkInput(username, "loginUsernameERR", "Username non conforme, per l'username si possono usare solo caratteri alfabetici ", CHECK_USERNAME);
  i += checkInput(password, "loginPasswordERR", "Password non conforme, per la password si possono usare solo caratteri alfanumerici", CHECK_PASSWORD);

  if(i > 0){
    document.querySelector('button').style["background-color"] = "red";
    button.disabled = true;
  }else{
    document.querySelector('button').style["background-color"] = "#336ef0";
    button.disabled = false;
  }
}

function checkRegister(){
  const button = document.querySelector('button');
  var i = 0;

  var mail = document.getElementById("REmail").value;
  var username = document.getElementById("RUsername").value;
  var name = document.getElementById("RName").value;
  var surname = document.getElementById("RSurname").value;
  var city = document.getElementById("RCity").value;
  var password = document.getElementById("RPassword").value;
  var RPassword = document.getElementById("RPasswordRepeat").value;

  i += checkInput(mail, "registerEmailERR", "Email non conforme, l'email deve essere in formato email", CHECK_EMAIL);
  i += checkInput(username, "registerUsernameERR", "Username non conforme, per l'username si possono usare solo caratteri alfanumerici ", CHECK_USERNAME);
  i += checkInput(name, "registerNameERR", "Nome non conforme, per il nome si possono usare solo caratteri alfabetici ", CHECK_NAME_AND_SURNAME);
  i += checkInput(surname, "registerSurnameERR", "Cognome non conforme, per ll cognome si possono usare solo caratteri alfabetici ", CHECK_NAME_AND_SURNAME);
  i += checkInput(city, "registerCityERR", "Città non conforme, per la città si possono usare solo caratteri alfabetici ", CHECK_CITY);
  i += checkInput(password, "registerPasswordERR", "Password non conforme, per la password si possono usare solo caratteri alfanumerici ", CHECK_PASSWORD);
  i += checkRepetedPassword(password, RPassword, "registerRPasswordERR", "Le password non combaciano");

  if(i > 0){
    document.querySelector('button').style["background-color"] = "red";
    button.disabled = true;
  }else{
    document.querySelector('button').style["background-color"] = "#336ef0";
    button.disabled = false;
  }
}

function checkInput(inputType, errorID, failureText, RE){
  if(inputType == ""){
    document.getElementById(errorID).innerHTML = "";
  }else if(!RE.test(inputType)){
      document.getElementById(errorID).innerHTML = failureText;
      return 1;
  }else{
    document.getElementById(errorID).innerHTML = "";
    return 0;
  }

  return 0;
}


function checkRepetedPassword(password, RPassword, errorID, failureText){
  const button = document.querySelector('button');

  if(password != "" && RPassword != ""){
    if(password != RPassword){
      document.getElementById(errorID).innerHTML = failureText;
      return 1;
    }else{
      document.getElementById(errorID).innerHTML = "";
      return 0;
    }
  }
  return 0;
}


function checkItem(item, re) {
    if (!item.value == "" && !re.test(item.value)) {
      setErrorBox(item);
      return false;
    }
    removeErrorBox(item, true);
    return true;
  }

function checkRegisterInput() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var nome = document.getElementById("nome");
    var tel = document.getElementById("cel");
    var cognome = document.getElementById("cognome");
    var nascita = document.getElementById("nascita");
    var repeatpassword = document.getElementById("repeatpassword");
    checkItem(password, RE_PASSWORD);
    checkItem(email, RE_EMAIL);
    checkItem(nome, RE_NOME);
    checkItem(cognome, RE_NOME);
    checkItem(tel, RE_TEL);
    checkNascita(nascita);
    checkRepeatPassword(password, repeatpassword);
  }











