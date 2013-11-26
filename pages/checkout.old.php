<?PHP include("../common/top.php"); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="PHP Shopping Cart Using Sessions" /> 
<meta name="keywords" content="shopping cart tutorial, shopping cart, php, sessions" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?PHP include("../common/base.php"); ?>
<link rel="stylesheet" type="text/css" href="css/form.css" />

<title>NewStar Marine - Cart</title>

<?PHP include("../scripts/db.php"); ?>


</head>
<body>


<div id="page">
            
            <?PHP include("../common/body_head.php"); ?>
            
            <?PHP include("../common/mainmenu.php"); ?>          
            
            <div id="content">
              <div id="text">
    
    <form>
    
    <fieldset>
    <legend>Personal Info</legend>
    
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
      }
  }
  ?>
    </fieldset>
    
    <br />
    
    <fieldset>
    <legend>Receipt</legend>
    
    <?php
	
	if($_SESSION['cart']) {	//if the cart isn't empty
		//show the cart
		
		echo "<table border=\"1\">";	//format the cart using a HTML table
      
      echo "<tr>";
          echo "<th>Item</th>";
          echo "<th>Qty</th>";
          echo "<th>Price</th>";
      echo "</tr>";

			//iterate through the cart, the $product_id is the key and $quantity is the value
			foreach($_SESSION['cart'] as $product_id => $quantity) {	
				
				//get the name, description and price from the database - this will depend on your database implementation.
				//use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
				$sql = sprintf("SELECT product_name, category_id, retail_price FROM my_products WHERE product_id = %d;", $product_id); 
					
				$result = mysql_query($sql);
				
				//Only display the row if there is a product (though there should always be as we have already checked)
				if(mysql_num_rows($result) > 0) {
				
					list($name, $description, $price) = mysql_fetch_row($result);
				
					$line_cost = $price * $quantity * 1.0;		//work out the line cost
					$total = $total + $line_cost;			//add to the total cost
				
					echo "<tr>";
						//show this information in table cells
						echo "<td align=\"center\">$name</td>";
						//along with a 'remove' link next to the quantity - which links to this page, but with an action of remove, and the id of the current product
						echo "<td align=\"center\">$quantity (<a href=\"javascript:void(0)\" onclick=\"updateCart('remove','$product_id', 'pages/checkout.php');\">-1</a>)</td>";
						echo "<td align=\"center\" class=\"price\" >$".(number_format((float)$line_cost, 2, '.', ''))."</td>";
					
					echo "</tr>";
					
				}
			
			}
			
			//show the total
			echo "<tr>";
				echo "<td colspan=\"2\" align=\"right\">Total</td>";
				echo "<td align=\"right\" class=\"price\" >$".(number_format((float)$total, 2, '.', ''))."</td>";
			echo "</tr>";
			
			//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation
			echo "<tr>";
			  echo "<td align=\"center\" colspan=\"3\"><a href=\"pages/products.php\">Continue Shopping</a></td>"; 
			echo "</tr>";		
			
			
		echo "</table>";
		
		
	
	}else{
		//otherwise tell the user they have no items in their cart
		echo "<div id=\"noCart\">You have no items in your shopping cart.</div>";
		
	}
	
	//function to check if a product exists
	function productExists($product_id) {
			//use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
			$sql = sprintf("SELECT * FROM my_products WHERE product_id = %d;", $product_id); 
				
			return mysql_num_rows(mysql_query($sql)) > 0;
	}

	?>
    </fieldset>
    
    <br />
    
    <fieldset>
    <legend>Submit</legend>
    
    </fieldset>
    
    </form>

              </div>
           </div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>


</body>
</html>
