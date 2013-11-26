<!-- body_head.php -->
<div id="body_head">
<?PHP
include("logo.php");
?>
<h2>4 Stroke Outboards, Boats, Inflatables, Scooters
&amp; More!</h2>
<hr />
<span id="serverMsg"></span>
<div id="welcome">
  <?php
  //Please make sure that you have called session_start()
  //at the beginning of the file that includes this script.
  $salutation = $_SESSION["salutation"];
  $customer_first_name = $_SESSION["customer_first_name"];
  $customer_middle_initial = $_SESSION["customer_middle_initial"];
  $customer_last_name = $_SESSION["customer_last_name"];
  $customer_id = $_SESSION["customer_id"];
  if ($nodisplay != true)
  {
      if ($customer_id == "")
      {
          //echo "<h5>Welcome!<br />";
          //echo "It's ".date("l, F jS").".<br />";
          //echo "Our time is ".date('g:ia').".</h5>";
          echo "<strong><a href = \"pages/login.php\">Click here to log in</a></strong>";
      }
      else
      {
          //echo "<h5>Welcome, " . $customer_first_name . "!<br />";
          echo  $salutation . " " .
          $customer_first_name . " " .
          $customer_middle_initial . " " .
          $customer_last_name . " ";
          //echo "It's ".date("l, F jS").".<br />";
          //echo "Our time is ".date('g:ia').".</h5>";
          echo "<strong>(<a href = \"pages/logout.php\">Logout</a>)</strong>";
          echo "<strong>(<a href = \"pages/checkout.php\">Checkout</a>)</strong>";
      }
  }
  
  ?>
</div>

<hr />
</div>