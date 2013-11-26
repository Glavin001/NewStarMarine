<?PHP include("../common/top.php"); ?>

<!-- processFeedbackForm.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Feedback</title>
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />
<script type="text/javascript"  src="scripts/feedbackForm.js"></script>
<?PHP include "db.php"; ?>
</head>

<body>
<div id="page">

<?PHP include("../common/body_head.php"); ?>

<?PHP include("../common/mainmenu.php"); ?>  

<div id="content">
<div id="text">

<?PHP
// processFeedbackForm.php

// Customer Variables
$customer_id = 0; 
$allCategories = array();
$allComments = array();
$allProducts = array();
$allRatings = array();
// Legacy code below
$salute = ""; 
$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$reply = "";
// ^ Using customer_id now to track customers.

$unprocessedFeedbackMessage = ""; // Unprocessed Feedback for mail message.

// Process input
// First iterate over all received input and obtain customer information 
// and build an array of information from the input.
foreach ($_POST as $key => $value) {
    // Process each individually
    switch ($key)
    {
    // Legacy code
      case "salute":
        if ($value != "Please select a title")
          $salute = $value;
        $fullName = (($salute != "")?"$salute ":""). $firstName . " " . $lastName;
        break;
      case "firstName":
        $firstName = $value;
        $fullName = (($salute != "")?"$salute ":""). $firstName . " " . $lastName;
        break;
      case "lastName":
        $lastName = $value;
        $fullName = (($salute != "")?"$salute ":""). $firstName . " " . $lastName;
        break;
      case "email":
        $email = $value;
        break;
      case "phone":
        $phone = $value;
        break;
      case "reply":
        $reply = $value;
        break;
      // ^ Using customer_id now to track customers.
      case "customer_id":
        $customer_id = $value;
        break;
      default:
        // Not basic information.
        // This info are complex parts for comments, ratings, purchase history, etc.
        $parts = explode(":",$key);
        // Process these complex parts.
        switch ($parts[0])
        {
          case "purchased": // Purchased categories
            array_push($allCategories, array((int) $parts[1],$value));
            break;     
          case "purchasedProd": // Purchased Products
            $tempCatProd = explode("_",$parts[1]);
            $tempCategory = (int) $tempCatProd[0];
            $tempProd = (int) $tempCatProd[1];
            array_push($allProducts, array($tempCategory,$tempProd,$value));
            break;
          case "comments": // Comments per category
            array_push($allComments, array($parts[1],$value));
            break;       
          case "rate": // Rating per product
            $tempCatProd = explode("_",$parts[1]);
            $tempCategory = (int) $tempCatProd[0];
            $tempProd = (int) $tempCatProd[1];
            array_push($allRatings, array($tempCategory,$tempProd,$value));
            break;
          default:
            // Nothing to do.
            //print_r($parts);
            break;
        }
        
        //echo $key . ' has the value of ' . $value . '<br />';
        $unprocessedFeedbackMessage .= "'$key' has the value of '$value'.\n";
        break;
        
    }
}

// Next, process the array of feedback information.
/*
echo "<pre>";
print_r($allCategories);
print_r($allComments);
print_r($allProducts);
print_r($allRatings);
echo "</pre>";
*/

$processedFeedbackMessage = "";
// Iterate through all purchased categories
for ($c=0; $c<count($allCategories); $c++)
{
  $currCategory = $allCategories[$c][0];
  if ($allCategories[$c][1] == "on") // Check if purchased from this category
  { 
    // Get category comment
    $catComment = "";
    for ($i=0; $i<count($allComments); $i++)
    {
      if ($allComments[$i][0] == $currCategory) // Check if this comment is for this category
      {
        $catComment = $allComments[$i][1];
        if ($catComment == "") $catComment = "No Comment";
        break;
      }
    }
  
    // Iterate through all purchased products of the current purchase category
    for ($p=0; $p<count($allProducts); $p++)
    {
      
      if ($allProducts[$p][0] == $currCategory && $allProducts[$p][2] == "on") // Check if purchased product
      {
        
        $currProduct = $allProducts[$p][1]; // Get product index num
        
        // Get product rating of current product
        $prodRating = 0;
        for ($i=0; $i<count($allRatings); $i++) // Check if this rating is for this product
        {
          if ($allRatings[$i][0] == $currCategory && $allRatings[$i][1] == $currProduct) 
          // Check if this comment is for this category
          {
            $prodRating = $allRatings[$i][2];
            break;
          }
        }
          
        /*
        $checkedStar = "★";
        $uncheckedStar = "☆";
        $ratingStars = (str_repeat($checkedStar,(int) $prodRating)).(str_repeat($uncheckedStar,5-(int) $prodRating));
        */
        
        // Submit the feedback to my_feedback table.
        $processedFeedbackMessage .= "Rating of '$prodRating' for purchased product number $currProduct of category number $currCategory, with comment:\n'$catComment'.\n";
               
        $query = "INSERT INTO my_feedback (
            feedback_id, category_id, product_id, 
            customer_id, rating, comment, timestamp
          )
          VALUES (
            NULL, '".mysql_real_escape_string(strip_tags($currCategory))."', '".
            mysql_real_escape_string(strip_tags($currProduct))."', '".
            mysql_real_escape_string(strip_tags($customer_id))."', '".
            mysql_real_escape_string(strip_tags($rating))."', '".
            mysql_real_escape_string(strip_tags($catComment))."', 
            NULL 
          );";
      $submitFeedback = mysql_query($query)
          or die(mysql_error());
      
        
      }
      
    }
  
  }

}

//Construct the message to be sent to the business
$subject = "Customer Feedback";
$businessEmail =  "csc35523@cs.smu.ca";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$messageHeader = '<html><head><title>Customer Feedback</title></head><body>';
$messageLogo = '<img src="http://cs.smu.ca/~csc35523/11/images/newstar_logo.png" alt="NewStar Marine Logo" /><br /><hr /><br />';

$message = '<table rules="all" style="border-color: #009;" cellpadding="10">';
$message .= "<tr style='background: #06F;'><td colspan='2'><strong>Customer Feedback Information</strong> </td></tr>";
$message .= "<tr><td><strong>Name:</strong> </td><td>" . strip_tags($fullName) . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($email) . "</td></tr>";
$message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($phone) . "</td></tr>";
$message .= "<tr><td><strong>Processed Feedback:</strong> </td><td><pre>" . htmlentities($processedFeedbackMessage) . "</pre></td></tr>";
$message .= "<tr><td><strong>Unprocessed Feedback:</strong> </td><td><pre>" . htmlentities($unprocessedFeedbackMessage) . "</pre></td></tr>";
$message .= "</table>";

$messageFooter .= "</body></html>";

$messageToBusiness = $messageHeader . $message . $messageFooter;

//Send the e-mail feedback message to the business
$headerToBusiness = "From: $email\r\n" ."Reply-To: ". strip_tags($email)."\r\n". $headers;
mail("$businessEmail", $subject, $messageToBusiness, $headerToBusiness);

//Construct the confirmation message to be e-mailed to the client
$messageToClient =
    "Dear ".$fullName.":<br />".
    "The following message was received from you by NewStar Marine:<br /><br />".
    $message.
    "<br /><hr /><br />".
    "We will contact you shortly with more information, after your feedback has been thoroughly processed.<br /><br />".
    "Thank you for the feedback and your patronage.<br />" .
    "The NewStar Marine Team<br />".
    "<br /><hr /><br />".
    "If this is not feedback from you or you wish not to be archived, ".
    "please don't hesitate to email us for any questions or concerns you may have.<br />";

//Send the confirmation message to the client
$headerToClient = "From: $businessEmail\r\n" ."Reply-To: ". strip_tags($businessEmail)."\r\n". $headers;
mail($email, "Re: ".$subject, ($messageHeader . $messageLogo . $messageToClient . $messageFooter), $headerToClient);

//Transform the confirmation message to the client into XHTML format and display it
$display = str_replace("\r\n", "<br />\r\n", $messageToClient);
echo $display;


//Log the message in a file called feedback.txt on the web server
$currDate = date("Y/m/d H:i:s");
$messageToLog = $curreDate . "\n";
$messageToLog .= "Full Name: $fullName\n";
$messageToLog .= "Email: $email\n";
$messageToLog .= "Phone: $phone\n";
$messageToLog .= "Unprocessed Feedback: \n$unprocessedFeedbackMessage\n";

$fileVar = fopen("../data/feedback.txt", "a")
    or die("Error: Could not open the log file.");
fwrite($fileVar, "\n-------------------------------------------------------\n")
    or die("Error: Could not write to the log file.");
fwrite($fileVar, "Date received: ".date("jS \of F, Y \a\\t H:i:s\n"))
    or die("Error: Could not write to the log file.");
fwrite($fileVar, $messageToLog)
    or die("Error: Could not write to the log file.");


?>

</div>
</div>
<?PHP include("../common/footer.php"); ?>

<br />

</div>

</body>
</html>

