<?PHP include("../common/top.php"); ?>

<!-- PurchaseForm.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Purchase Form</title>
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />
<script type="text/javascript" src="scripts/purchaseForm.js"></script>
</head>

<body>
<div id="page">

            <?PHP include("../common/body_head.php"); ?>

            <?PHP include("../common/mainmenu.php"); ?>           

<div id="content">
<div id="text">

<h3>Purchase Form</h3>
<p>
Please fill out the form below to purchase and submit it to NewStar Marine for processing. We will contact you to confirm your purchase via email.
</p>

<form id="purchaseForm" action="" method="post" onsubmit="return validatePurchaseForm();">

<fieldset>
<legend><b>Personal Information</b></legend>

<table summary="Purchase Form - Personal">

<tr valign="top">
<td colspan="1"><label for="salute">
Salutation:
</label></td>
<td colspan="2">
<select id="salute" name="salute">
<option>Please select a title</option>
<option>Mrs.</option>
<option>Ms.</option>
<option>Mr.</option>
<option>Dr.</option>
</select>
</td>
<td colspan="3">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="1"><label for="firstName">
First Name<a name="firstName" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" id="firstName" name="firstName" size="50" /> </td>
<td colspan="1">&nbsp; &nbsp;</td>
<td colspan="1"><label for="lastName">
Last Name<a name="lastName" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" id="lastName" name="lastName" size="50" /> </td>
</tr>

<tr valign="top">
<td colspan="1"><label for="email">
E-mail Address<a name="email" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" id="email" name="email" size="50" /></td>
<td colspan="1">&nbsp; &nbsp;</td>
<td colspan="1"><label for="phone">
Phone Number<a name="firstName" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" id="phone" name="phone" size="50" /></td>
</tr>

</table>
</fieldset>

<table summary="Break">
<tr><td>&nbsp;</td></tr>
</table>

<fieldset>
<legend><strong>Product Information</strong></legend>

<table summary="Purchase Form - Product Information">

<tr valign="top">
<td colspan="2"><label for="category">
1) Select a category<a name="category" class="formRequired">*</a>:
</label></td>
<td colspan="2">
<select id="category" name="category">
<option>Please select a category</option>
<!-- JavaScript disabled warning -->
<option>If you are seeing this, please enable JavaScript</option>
<!-- Sample categories -->
<!--
<option>Outboard Motors</option>
<option>Inflatables</option>
<option>Scooters</option>
-->
</select>
</td>
<td colspan="1">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="2"><label for="product">
2) Select a product<a name="product" class="formRequired">*</a>:
</label></td>
<td colspan="3">
<select id="product" name="product">
<option>Please select a product</option>
<!-- JavaScript disabled warning -->
<option>If you are seeing this, please enable JavaScript</option>
<!-- Sample products -->
<!--
<option>$795.00 - 2.6-HP - Outboard Motors</option>
<option>$1,095.00 - 5-HP - Outboard Motors</option>
<option>$1,795.00 - 9.8-HP - Outboard Motors</option>
<option>$2,095.00 - 15-HP - Outboard Motors</option>
<option>$100.00 - APS Wind - Inflatables</option>
<option>$200.00 - APS Pro - Inflatables</option>
<option>$300.00 - APS Pro Sport - Inflatables</option>
<option>$350.00 - APS Fly - Inflatables</option>
<option>$400.00 - APS Star - Inflatables</option>
<option>$2,000.00 - Electric Scooter - Scooters</option>
<option>$1,500.00 - Gas Scooter - Scooters</option>
-->
</select>
<em>Note: Price listed here does not include tax.</em>
</td>
<td colspan="1">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="2"><label for="quantity">
3) Enter a quantity<a name="quantity" class="formRequired">*</a>:
</label></td>
<td colspan="2"><input type="text" id="quantity" name="quantity" value="0"></input></td>
<td colspan="2">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="2">
<label for="tax">Item Tax Price:</label>
</td>
<td colspan="2">
<input type="text" id="tax" name="tax" readonly="readonly" value="Not Yet Calculated"></input>
</td>
<td colspan="3">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="2">
<label for="total">Item Total Price:</label>
</td>
<td colspan="2">
<input type="text" id="total" name="total" readonly="readonly" value="Not Yet Calculated"></input>
</td>
<td colspan="2">&nbsp;</td>
</tr>

<tr valign="top">
<td colspan="6">
4) Verify prices and click <input type="button" name="add2Cart" onclick="addToCart();" value="Add to Cart" />.
</td>
</tr>

<tr valign="top">
<td colspan="6">

<table summary="Receipt" id="receipt" border="2">
<tr>
<th colspan="6">Receipt</th>
</tr>
<tr>
<th>Category</th>
<th>Product</th>
<th>Product Price</th>
<th>Quantity</th>
<th>Total Price</th>
<th>Remove?</th>
</tr>
<!--
<tr>
<td>Outboards</th>
<td>2.6 HP</td>
<td>$795.00</td>
<td>1</td>
<td>$795.00</td>
<td><input type="button" onclick="removeFromCart(0);" value="Remove" /></td>
</tr>
-->
<tr><td colspan="6"></td></tr>
<tr>
<td colspan="4">Total (before tax)</td>
<td colspan="1">$0.00</td>
</tr>
<tr class="tax">
<td colspan="4" class="tax">Tax</td>
<td colspan="1" class="tax">$0.00</td>
</tr>
<tr>
<td colspan="4">Total</td>
<td colspan="2">$0.00</td>
</tr>

</table>

</td>
</tr>

<tr valign="top">
<td colspan="3">
<label for="taxExempt">Are you applicable for tax-exemption? Check for yes.</label>
<input type="checkbox" id="taxExempt" name="taxExempt" />
</td>
</tr>

<tr>
<td>
<!-- Stores 3 arrays, with comma separators, 
to be parsed later by the PHP receiving this form. -->
<input type="hidden" id="cartData_category" name="cartData_category" />
<input type="hidden" id="cartData_product" name="cartData_product" />
<input type="hidden" id="cartData_quantity" name="cartData_quantity" />
</td>
</tr>


</table>
</fieldset>

<table summary="Break">
<tr><td>&nbsp;</td></tr>
</table>

<fieldset>
<legend><b>Submit Information</b></legend>

<table summary="Purchase Form - Submit">

<tr>
<td colspan="6">
<label for="replyYes">
Please check here to accept that you will receive an email reply
<a name="replyYes" class="formRequired">*</a>:
</label>
&nbsp;
<label for="replyYes">Yes</label>
<input type="radio" id="replyYes" name="reply" value="Yes" /> &nbsp;
<label for="replyNo">No</label>
<input type="radio" id="replyNo" name="reply" value="No" checked="checked" />
</td>
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


