<?php
//login.php
session_start();
if ($_SESSION["customer_id"] != "") header('Location: ../my_business.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>NewStar Marine - Logging In</title>
    <?PHP include("../common/base.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <script type="text/javascript" src="scripts/login.js"></script>
  </head>
  <body>
    <div id="page">
      <?PHP include("../common/body_head.php"); ?>      
      <?PHP include("../common/mainmenu.php"); ?>           

      <div id="content">
        <div id="text" class="FeedbackForm">          
          <h4>Login Form</h4>
          
          <p><a href="pages/register.php" class="noDecoration">If you have not yet
            registered for our e-store, please click here to register.</a></p>
          
          <br />
          <hr />
          <br />
          
          <p>
          You can login to your account here, 
          so that you may make purchases and add to your cart.
          </p>
          
          <form id="loginForm" name="loginForm" 
                action="scripts/processLogin.php" method="post"
                onsubmit="return validateLoginForm();">
                
          <fieldset>
          <legend><strong>Login</strong></legend>
          
            <table summary="Login Form">
              <tr>
                <td>User Login (Email):</td>
                <td valign="top"><input name="customer_nm" type="text"
                id="customer_nm" size="20" /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td valign="top"><input name="customer_pw" type="password"
                id="customer_pw" size="20" /></td>
              </tr>
              <tr>
                <td><input type="submit" value="Login" /></td>
                <td><input type="reset" value="Reset Form" /></td>
              </tr>
              <?php if ($retry == true) { ?>
              <tr><td><hr /></td></tr>
              <tr>
                <td valign="top" colspan="2">There was an error in the login.<br />
                 Either username or password was incorrect.<br />
                 Please re-enter the correct login information.</td>
              </tr>
              <?php } ?>
            </table>
            
            </fieldset>
            </form>
          </div>
      </div>
<?PHP include("../common/footer.php"); ?>
<br />
    </div>
  </body>
</html>
