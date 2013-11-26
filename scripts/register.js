//register.js
function validateRegistrationForm()
{
   var firstName = register.firstName.value;
   var lastName = register.lastName.value;
   var phone = register.phone.value;
   var email = register.email.value;
   var check = true;
   if (!validateName(firstName))
   {
       alert("Invalid first name");
       check = false;
   }
   if (!validateName(lastName))
   {
       alert("Invalid last name");
       check = false;
   }
   if (!validateName(middleInitial))
   {
       alert("Invalid middle initial");
       check = false;
   }
   if (!validateWord(login_name))
   {
       alert("Invalid login name");
       check = false;
   }
   if (!validateWord(login_password))
   {
       alert("Invalid login password");
       check = false;
   }
   if (!validateName(city))
   {
       alert("Invalid city");
       check = false;
   }
   if (!validateName(state))
   {
       alert("Invalid state");
       check = false;
   }
   if (!validatePhone(phone))
   {
       alert("Invalid phone number");
       check = false;
   }
   if (!validateEmail(email))
   {
       alert("Invalid e-mail address");
       check = false;
   }
   return check;
}

function validateName(name)
{
    var p1 = name.search(/^[-'\w\s]+$/);
    return (p1 == 0) ? true : false;
}

function validateWord(name)
{
    var p1 = name.search(/^\w+$/);
    return (p1 == 0) ? true : false;
}

function validatePhone(phone)
{
    var p1 = phone.search(/^\d{3}[-\s]{0,1}\d{3}[-\s]{0,1}\d{4}$/);
    var p2 = phone.search(/^\d{3}[-\s]{0,1}\d{4}$/);
    return (p1 == 0 || p2 == 0) ? true : false;
}

function validateEmail(address)
{
    var p1 = address.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);
    return (p1 == 0) ? true : false;
}
