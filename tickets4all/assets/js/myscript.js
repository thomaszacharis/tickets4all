function headerSearch(){
    console.log("searched");
}

function validateUserLoginCredentials(){
 
  var email = document.forms["UserLogin"]["email"].value;
  if (!emailIsValid(email)) {
    alert("E-mail is not valid!");
    return false;
  }
}

function emailIsValid (email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function validateUserRegisterFields(){
  var formName = "UserRegister";

  var email = document.forms[formName]["email"].value;
  if (!emailIsValid(email)) {
    alert("E-mail is not valid!");
    return false;
  }

  var pass = document.forms[formName]["pass"].value;
  var minPassLength = 6;
  var maxPassLength = 24;
  if (pass.length < minPassLength || pass.length > maxPassLength) {
    alert("Pass must have a length of 6 to 24 characters!");
    return false;
  }
}

function sendContactMessage(){
  alert("Message Sent! Thank you!");
}


function validateBookTicket(){
  var ticketsQuantity = document.forms["BookTicket"]["ticketsQuantity"].value;
  if (ticketsQuantity.length > 2) {
    alert("Tickets quantity is invalid!");
    return false;
  }
}