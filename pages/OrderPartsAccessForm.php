<?PHP include("../common/top.php"); ?>

<!-- OrderPartsAccessForm.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Order Parts &amp; Accesories</title>
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />
</head>

<body>
<div id="page">

<?PHP include("../common/body_head.php"); ?>

<?PHP include("../common/mainmenu.php"); ?>            

<div id="content">
<div id="text">

<h3>Order Parts &amp; Accessories - Coming Soon!</h3>
<p>
Please fill out the below to order your part or accessory.
</p>

<form id="order" action="">
<fieldset>
<legend>Order Form</legend>
<table summary="Order Form">

<tr valign="top">
<td colspan="1">
<label for="salute">Salutation:</label>
</td>
<td colspan="2">
<select id="salute" name="salute">
<option> </option>
<option>Mrs.</option>
<option>Ms.</option>
<option>Mr.</option>
<option>Dr.</option>
</select>
</td>
</tr>

<tr valign="top">
<td colspan="1"><label for="firstName">First Name:</label></td>
<td colspan="2"><input type="text" id="firstName" name="firstName" size="60" />
</td>
<td colspan="1"><label for="lastName">Last Name:</label></td>
<td colspan="2"><input type="text" id="lastName" name="lastName" size="60" /> </td>
</tr>

<tr valign="top">
<td colspan="1"><label for="email">E-mail Address:</label></td>
<td colspan="2"><input type="text" id="email" name="email" size="60" /></td>
<td colspan="1"><label for="phone">Phone Number:</label></td>
<td colspan="2"><input type="text" id="phone" name="phone" size="60" /></td>
</tr>

<tr valign="top">
<td colspan="1"><label for="partId">Part Number:</label></td>
<td colspan="2"><input type="text" id="partId" name="partId" size="60" /></td>
</tr>

<tr valign="top">
<td colspan="6"><label for="comments">Comments:</label></td>
</tr>
<tr valign="top">
<td colspan="6"><textarea id="comments" name="comments" rows="12" cols="120"></textarea></td>
</tr>

<tr>
<td colspan="6">Please check here if you accept that you will receive a reply:
<input type="checkbox" name="reply" value="yes" /></td>
</tr>

<tr>
<td><input type="submit" value="Send Order" /></td>
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

