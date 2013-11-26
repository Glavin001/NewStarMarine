<?PHP include("../common/top.php"); ?>

<!-- FeedbackForm.html -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Feedback</title>
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />
<script type="text/javascript"  src="scripts/feedbackForm.js"></script>
<?PHP include("../scripts/db.php"); ?>
</head>

<body>
<div id="page">

<?PHP include("../common/body_head.php"); ?>

<?PHP include("../common/mainmenu.php"); ?>         

<div id="content">
<div id="text">

<h3>Feedback Form</h3>
<p>
NewStar Marine wants to continue to give a great customer experience. 
If you have any feedback for us, it would be greatly appreciated.
</p>

<form id="feedbackForm" method="post" action="scripts/processFeedbackForm.php" onsubmit="return validateFeedbackForm();">
<fieldset>
<legend><strong>Personal Information</strong></legend>

<table summary="Feedback Form">

<tr>
<td colspan="6">
<?php
  //Please make sure that you have called session_start()
  //at the beginning of the file that includes this script.
  $salutation = $_SESSION["salutation"];
  $customer_first_name = $_SESSION["customer_first_name"];
  $customer_middle_initial = $_SESSION["customer_middle_initial"];
  $customer_last_name = $_SESSION["customer_last_name"];
  $customer_id = $_SESSION["customer_id"];
  $customer_email_address = "";
  $customer_phone_number = "";
  $customer_address = "";

  if ($customer_id == "")
  {
      echo "<strong><a href=\"pages/login.php\" >Login to your pre-existing customer account.</a></strong><br /><br />";
  }
  else
  {
      echo "<input type=\"hidden\" id=\"customer_id\" name=\"customer_id\" value=\"".$customer_id."\" />";
      
      $sql = "SELECT customer_id, email_address, phone_number, address, town_city, county, country FROM my_customers WHERE customer_id = '".($_SESSION['customer_id'])."' LIMIT 1;";
      $result = mysql_query($sql) or die(mysql_error());
      $row = mysql_fetch_assoc($result);
      
      $customer_email_address = $row['email_address'];
      $customer_phone_number = $row['phone_number'];
      $customer_address = $row['address'];   
  }
?>
</td>
</tr>

<tr valign="top">
<td colspan="1"><label for="salute">
Salutation
</label></td>
<td colspan="2">
<select id="salute" name="salute" disabled="disabled" >
<option <?PHP echo (($salutation=="")?"selected=\"selected\"":"")?> >Please select a title</option>
<option <?PHP echo (($salutation=="Mrs.")?"selected=\"selected\"":"")?> >Mrs.</option>
<option <?PHP echo (($salutation=="Ms.")?"selected=\"selected\"":"")?> >Ms.</option>
<option <?PHP echo (($salutation=="Mr.")?"selected=\"selected\"":"")?> >Mr.</option>
<option <?PHP echo (($salutation=="Dr.")?"selected=\"selected\"":"")?> >Dr.</option>
</select>
</td>
<td colspan="3">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="1"><label for="firstName">
First Name<a name="firstName" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" readonly="readonly" id="firstName" name="firstName" size="50"  value="<?PHP echo $customer_first_name; ?>"/>
</td>

<td colspan="1"><label for="lastName">
Last Name<a name="lastName" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" readonly="readonly" id="lastName" name="lastName" size="50" value="<?PHP echo $customer_last_name; ?>"/> </td>
</tr>

<tr valign="top">
<td colspan="1"><label for="email">
E-mail Address<a name="email" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" readonly="readonly" id="email" name="email" size="50"  value="<?PHP echo $customer_email_address; ?>"/></td>

<td colspan="1"><label for="phone">
Phone Number<a name="phone" class=""></a>:
</label></td>
<td colspan="2"><input type="text" readonly="readonly" id="phone" name="phone" size="50"  value="<?PHP echo $customer_phone_number; ?>"/></td>
</tr>

<!--
<tr valign="top">
<td colspan="1"><label for="partId">
Part Number:
</label></td>
<td colspan="2"><input type="text" id="partId" name="partId" size="50" /></td>
<td colspan="3">&nbsp;</td>
</tr>
-->

<tr valign="top">
<td>

</td>
</tr>

</table>

</fieldset>

<table summary="Break">
<tr><td>&nbsp;</td></tr>
</table>

<fieldset>
<legend><strong>Feedback</strong></legend>

<table summary="Feedback" id="feedback">

<tr valign="top">
<td>
<label for="purchased:0">Purchased from the category, <strong>Outboards Motors</strong>: </label>
<input type="checkbox" id="purchased:0" name="purchased:0" />
</td>
</tr>

<tr valign="top">
<td>
<label for="comments:0">
Comments for this category<a name="comments:0" class="formRequired">*</a>:
</label></td>
</tr>

<tr valign="top">
<td>
<textarea id="comments:0" name="comments:0" rows="12" cols="120"></textarea></td>
</tr>

<tr valign="top">
<td>
<h4>What products did you purchase?</h4>
</td>
</tr>

<tr valign="top">
<td>
<!--
a) products/services
 a checkbox for each tem to indicate whether the user has purchased it.
 Sequence of radio buttons to indicate the level of satisfaction for their purchase.
-->
<label for="purchasedProd:0.0">Purchased <strong>2.6 HP</strong>:</label>
<input type="checkbox" id="purchasedProd:0.0" name="purchasedProd:0.0" />
</td>
</tr>

<tr valign="top">
<td>
If you purchased this, how satisfied were you with your purchase?<br />
Not satisfied 
1 <input type="radio" name="rate:0.1" value="1"></input>
2 <input type="radio" name="rate:0.1" value="2"></input>
3 <input type="radio" name="rate:0.1" value="3"></input>
4 <input type="radio" name="rate:0.1" value="4"></input>
5 <input type="radio" name="rate:0.1" value="5"></input>
6 <input type="radio" name="rate:0.1" value="6"></input>
7 <input type="radio" name="rate:0.1" value="7"></input>
8 <input type="radio" name="rate:0.1" value="8"></input>
9 <input type="radio" name="rate:0.1" value="9"></input> 
10 <input type="radio" name="rate:0.1" value="10"></input>
Very satisfied
<input type="radio" name="rate:0.1" value="0" checked="checked"></input>
Not Applicable/Unknown 
</td>
</tr>

<tr><td><hr /></td></tr>

</table>
</fieldset>

<table summary="Break">
<tr><td>&nbsp;</td></tr>
</table>

<fieldset>
<legend><strong>Submit Information</strong></legend>

<table summary="submitInfo">

<tr>
<td colspan="6"><label for="reply">Please check here to accept that you will receive an email reply
<a name="reply" class="formRequired">*</a>:
</label>
<input type="checkbox" id="reply" name="reply" value="yes" /></td>
</tr>

<tr>
<td><input type="submit" id="submit" value="Send Order" /></td>
<td align="right"><input type="reset" value="Reset Form" /></td>
</tr>

</table>

</fieldset>

</form>
<br />

</div>
</div>

<?PHP include("../common/footer.php"); ?>

<br />

</div>

</body>
</html>

