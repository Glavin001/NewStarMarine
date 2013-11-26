<?PHP include("../common/top.php"); ?>

<!-- SubmitTestimonialForm.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Submit Your Own Testimonial</title>
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />

</head>

<body>
<div id="page">

            <?PHP include("../common/body_head.php"); ?>

            <?PHP include("../common/mainmenu.php"); ?>           

<div id="content">
<div id="text">

<h3>Testimonial Form</h3>
<p>
NewStar Marine wants to continue to give a great customer experience. 
If you've had a great experience with us and wish to please don't hesitate
to do so here.
</p>

<form id="testimonial" action="">
<fieldset>
<legend><strong>Your Testimonial</strong></legend>

<table summary="Testimonial Form">
<tr valign="top">
<td>Salutation:</td>
<td><select name="salute">
<option> </option>
<option>Mrs.</option>
<option>Ms.</option>
<option>Mr.</option>
<option>Dr.</option>
</select></td>
</tr>
<tr valign="top">
<td>First Name:</td>
<td><input type="text" name="firstName" size="120" /></td>
</tr>
<tr valign="top">
<td>Last Name:</td>
<td><input type="text" name="lastName" size="120" /></td>
</tr>
<tr valign="top">
<td>E-mail Address:</td>
<td><input type="text" name="email" size="120" /></td>
</tr>
<tr valign="top">
<td>Phone Number:</td>
<td><input type="text" name="phone" size="120" /></td>
</tr>
<tr valign="top">
<td>About You:</td>
<td><textarea name="about" rows="12" cols="100">
</textarea></td>
</tr>
<tr valign="top">
<td>Your Testimonial:</td>
<td><textarea name="message" rows="12" cols="100">
</textarea></td>
</tr>
<tr>
<td colspan="2">Please check here if you wish to receive a reply:
<input type="checkbox" name="reply" value="yes" /></td>
</tr>
<tr>
<td colspan="2">Please check here if you wish to allow NewStar Marine 
to share your testimonial on our 
<a href="pages/Testimonials.php">testimonials page</a>.
<input type="checkbox" name="share" value="yes" /></td>
</tr>
<tr>
<td><input type="submit" value="Send Testimonial" /></td>
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

