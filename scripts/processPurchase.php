<?php
include("../common/top.php");
//processPurchase.php
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="PHP Shopping Cart Using Sessions" /> 
<meta name="keywords" content="shopping cart tutorial, shopping cart, php, sessions" />
<?PHP include("../common/base.php"); ?>
<title>NewStar Marine - Processing Purchase</title>
<?PHP include("../scripts/db.php"); ?>
</head>
<body>

<div id="page">
            
            <?PHP include("../common/body_head.php"); ?>
            
            <?PHP include("../common/mainmenu.php"); ?>          
            
            <div id="content">
              <div id="text">

<?php

if($_SESSION['cart']) {	//if the cart isn't empty

$customer_id = $_SESSION['customer_id'];
$billMsg = "";
//iterate through the cart, the $product_id is the key and $quantity is the value
foreach($_SESSION['cart'] as $product_id => $quantity) 
{

$query = "INSERT INTO my_purchases
    (
        purchase_id,
        customer_id,
        purchase_timestamp,
        product_id,
        quantity
    )
    VALUES
    (
        NULL,
        '$customer_id',
        NULL,
        '$product_id',
        '$quantity'
    );";
    mysql_query($query)
        or die(mysql_error());

// echo "Purchased $product_id <br />";

$query = "UPDATE my_products SET new_inventory=new_inventory - $quantity WHERE product_id = '$product_id';";
    mysql_query($query)
        or die(mysql_error());

// For confirmation email
$billMsg .= "<tr><td>$product_id</td><td>$quantity</td></tr>";

}

// Finished processing all of the cart
  $salutation = $_SESSION["salutation"];
$customer_first_name = $_SESSION["customer_first_name"];
  $customer_middle_initial = $_SESSION["customer_middle_initial"];
  $customer_last_name = $_SESSION["customer_last_name"];
  $fullName = "";
  $fullName .= (($salutation != "")?"$salutation ":"");
  $fullName .= $customer_first_name . " ";
  $fullName .= (($customer_middle_initial != "")?"$customer_middle_initial ":"");
  $fullName .= $customer_last_name;

 $customerInfoQuery = "SELECT customer_id, email_address, phone_number, address, town_city, county, country FROM my_customers WHERE customer_id = '".($_SESSION['customer_id'])."' LIMIT 1;";
      $moreCustomerInfo = mysql_query($customerInfoQuery) or die(mysql_error());
      $customerInfoRow = mysql_fetch_assoc($moreCustomerInfo);
      $customer_email_address = $customerInfoRow['email_address'];
     
// Send email
//Construct the message to be sent to the business
$subject = "Customer Purchase";
$businessEmail =  "csc35523@cs.smu.ca";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$messageHeader = '<html><head><title>Customer Purchase</title></head><body>';
$messageLogo = '<img src="http://cs.smu.ca/~csc35523/11/images/newstar_logo.png" alt="NewStar Marine Logo" /><br /><hr /><br />';

$message = '<table rules="all" style="border-color: #009; width: 100%;" cellpadding="10">';
$message .= "<tr style='background: #06F;'><td colspan='2'><strong>Purchase Bill</strong> </td></tr>";
$message .= "<tr><td><strong>Customer Id:</strong> </td><td>" . $_SESSION['customer_id'] . "</td></tr>";
$message .= "<tr style='background: #06F;'><td colspan='1'><strong>Product ID</strong> </td><td colspan='1'>Quantity</td></tr>";
$message .= $billMsg;
$message .= "</table>";

$messageFooter .= "</body></html>";

$messageToBusiness = $messageHeader . $message . $messageFooter;

//Send the e-mail feedback message to the business
$headerToBusiness = "From: $email\r\n" ."Reply-To: ". strip_tags($customer_email_address)."\r\n". $headers;
mail("$businessEmail", $subject, $messageToBusiness, $headerToBusiness);

//Construct the confirmation message to be e-mailed to the client
$messageToClient =
    "Dear ".$fullName.":<br />".
    "The following purchase request was received from you by NewStar Marine:<br /><br />".
    $message.
    "<br /><hr /><br />".
    "We will contact you shortly with more information, after your purchase has been thoroughly processed.<br /><br />".
    "Thank you for the feedback and your patronage.<br />" .
    "The NewStar Marine Team<br />".
    "<br /><hr /><br />".
    "If this is not a purchase from you or for any other reason, ".
    "please don't hesitate to email us for any questions or concerns you may have.<br />";

//Send the confirmation message to the client
$headerToClient = "From: $businessEmail\r\n" ."Reply-To: ". strip_tags($businessEmail)."\r\n". $headers;
mail($customer_email_address, "Re: ".$subject, ($messageHeader . $messageLogo . $messageToClient . $messageFooter), $headerToClient);

echo $messageToClient;

} else {
    //otherwise tell the user they have no items in their cart
		echo "<div id=\"noCart\">You have no items in your shopping cart.</div>";
		//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation
		echo "<div><a href=\"pages/products.php\">Continue Shopping</a></div>";
}

?>

<script type="text/javascript" language="javascript">
  updateCart('empty', '', '');
</script>


    </div>
           </div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>


</body>
</html>
