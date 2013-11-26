<?PHP include("../common/top.php"); ?>

<!-- register.php -->
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>NewStar Marine - Registration Form</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <?PHP include("../common/base.php"); ?>
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <script type="text/javascript" src="scripts/register.js"></script>
  </head>
  <body>
    <div id="page">
      <?PHP include("../common/body_head.php"); ?>
            
      <?PHP include("../common/mainmenu.php"); ?>  
      <div id="content">
        <div id="text" class="FeedbackForm">
          <h4>Registration Form</h4>
          <p>
          Please register here to create your account for future purchases.
          </p>
          
          <form id="register" name="register" action="pages/registration.php"
            method="post" onsubmit="return validateRegistrationForm();">
            <fieldset>
            <legend><strong>Personal Information</strong></legend>
            
            <table summary="Registration Form">
              <tr valign="top">
                <td>Salutation:</td>
                <td><select id="salute" name="salute">
                  <option></option>
                  <option>Mrs.</option>
                  <option>Ms.</option>
                  <option>Mr.</option>
                  <option>Dr.</option>
                </select></td>
              </tr>
              <tr valign="top">
                <td>First Name:</td>
                <td><input  id="firstName" type="text" name="firstName"
                size="40" /></td>
              </tr>
              <tr valign="top">
                <td>Middle Initial:</td>
                <td><input  id="middleInitial" type="text" name="middleInitial"
                size="4" /></td>
              </tr>
              <tr valign="top">
                <td>Last Name:</td>
                <td><input  id="lastName" type="text" name="lastName"
                size="40" /></td>
              </tr>
              <!--
              <tr valign="top">
                <td>Gender:</td>
                <td><select id="gender" name="gender">
                  <option></option>
                  <option>Female</option>
                  <option>Male</option>
                  <option>Other/Do not want to disclose</option>
                </select></td>
              </tr>
              -->
              
              </table>
              </fieldset>
              
              <table summary="Break">
              <tr><td>&nbsp;</td></tr>
              </table>
              
              <fieldset>
              <legend><strong>Login Account Information</strong></legend>
              
              <table summary="User Login Account Information">
              
              <tr valign="top">
                <td>Login E-mail (Username):</td>
                <td><input id="email" type="text" name="email" size="40" /></td>
              </tr>
              <!--
              <tr valign="top">
                <td>Preferred Login Name:</td>
                <td><input id="loginName" type="text" name="loginName"
                size="40" /></td>
              </tr>
              -->
              <tr valign="top">
                <td>Login Password:</td>
                <td><input id="loginPassword" type="password" name="loginPassword"
                size="40" /></td>
              </tr>
              <tr valign="top">
                <td>Phone Number:</td>
                <td><input id="phone" type="text" name="phone" size="40" /></td>
              </tr>
              <tr valign="top">
                <td>Street Address:<br />(include postal code)</td>
                <td><textarea id="address" name="address" rows="2" cols="30"></textarea></td>
              </tr>
              <tr valign="top">
                <td>City:</td>
                <td><input id="city" type="text" name="city"
                size="40" /></td>
              </tr>
              <tr valign="top">
                <td>State/Province:</td>
                <td><input id="state" type="text" name="state"
                size="40" /></td>
              </tr>
              <tr valign="top">
                <td>Country:</td>
                <td><select id="country" name="country">
                  <option></option>
                  <option>USA</option>
                  <option>Canada</option>
                </select></td>
              </tr>
              <tr>
                <td><input type="submit" value="Submit Form Data" /></td>
                <td align="right"><input type="reset" value="Reset Form" /></td>
              </tr>
            </table>
            
            </fieldset>
            
          </form>
        </div>
      </div>
      <br />
      <?PHP include("../common/footer.php"); ?>
    <br />
    </div>
  </body>
</html>
