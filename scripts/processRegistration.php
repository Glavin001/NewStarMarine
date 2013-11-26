<?php
//processRegistration.php
///////////////////// main begins ///////////////////////
/*
if ($gender == "Female") $gender = "F";
else if ($gender == "Male") $gender = "M";
else $gender = "O";
*/

if (validateInput() == True)
{

  if (emailExists($email))
  {
      echo "<h3 class=\"margin10\">Sorry, but your e-mail address is already 
          registered.</h3>";
      echo "<h3 class=\"margin10\">[Exercise: Implement mailing  
          username and password to the e-mail address.]</h3>";
  }
  else
  {
  /*
      $unique_login = getUniqueID($loginName);
      if ($unique_login != $loginName)
      {
          echo "<h3 class=\"margin10\">Your preferred login name exists.<br />
              So ... we have assigned $unique_login as your login name.</h3>";
      }
  */
      
      $cleanpw = crypt(
      md5(strip_tags($_POST['loginPassword'])),
      md5(strip_tags($_POST['email']))
      );
  
      $query = "INSERT INTO my_customers (
          customer_id, salutation, customer_first_name, customer_middle_initial,
          customer_last_name, email_address,
          login_password, phone_number, address, town_city, county, country
      )
      VALUES (
          NULL, '".mysql_real_escape_string(strip_tags($_POST['salute']))."', '".
          mysql_real_escape_string(strip_tags($_POST['firstName']))."', '".
          mysql_real_escape_string(strip_tags($_POST['middleInitial']))."', '". 
          mysql_real_escape_string(strip_tags($_POST['lastName']))."', '".
          mysql_real_escape_string(strip_tags($_POST['email']))."', '".
          mysql_real_escape_string($cleanpw)."', '".
          mysql_real_escape_string(strip_tags($_POST['phone']))."', '".
          mysql_real_escape_string(strip_tags($_POST['address']))."', '".
          mysql_real_escape_string(strip_tags($_POST['city']))."', '".
          mysql_real_escape_string(strip_tags($_POST['state']))."', '".
          mysql_real_escape_string(strip_tags($_POST['country']))."'
      );";
      $customers = mysql_query($query)
          or die(mysql_error());
      echo "<h3 class=\"margin10\">Thank you for registering with our e-store.</h3>";
      echo "<h3 class=\"margin10\"><a class=\"noDecoration\" href = \"pages/login.php\">
          Please click here to login and start shopping.</a></h3>";
  }

}
else
{
// Blank
echo "<h3>Please go to our <a href=\"pages/register.php\">registration page</a> to register your account before purchasing.</h3>"; 
}

///////////////////// main ends functions begin ///////////////////////
function emailExists($email)
{
    $query = "SELECT * FROM my_customers WHERE email_address = '".$email."'";
    $customers = mysql_query($query)
        or die(mysql_error());
    $numRecords = mysql_num_rows($customers);
    if ($numRecords > 0)
        return true;
    else
        return false;
}

function validateInput()
{

// For now, this simply checks if the page has been submitted without input.
// Blank input can occur when the processRegistration.php page has been opened 
// without being redirected from the register.php page.

return True;
/*

if ($firstName == "")
{
return False;
}
if ($lastName == "")
{
return False;
}
if ($email_address == "")
{
return False;
}
if ($login_password == "")
{
return False;
}
if ($phone == "")
{
return False;
}
if ($address == "")
{
return False;
}
if ($city == "")
{
return False;
}
if ($state == "")
{
return False;
}
if ($country == "")
{
return False;
}
*/

return True;


}

/*
function getUniqueID($loginName)
{
    $unique_login = $loginName;
    $query = "SELECT * FROM my_customers WHERE login_name = '$unique_login'";
    $customers = mysql_query($query)
        or die(mysql_error());
    $numRecords = mysql_num_rows($customers);
    for ($i = 0; $numRecords > 0; $i++)
    {
        $unique_login = $loginName.$i;
        $query = "SELECT * FROM my_customers WHERE login_name = '$unique_login'";
        $customers = mysql_query($query)
            or die(mysql_error());
        $numRecords = mysql_num_rows($customers);
    }
    return $unique_login;
}
*/

?>
