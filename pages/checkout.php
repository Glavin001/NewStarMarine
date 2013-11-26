<?PHP include("../common/top.php"); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="PHP Shopping Cart Using Sessions" /> 
<meta name="keywords" content="shopping cart tutorial, shopping cart, php, sessions" />
<?PHP include("../common/base.php"); ?>
<title>NewStar Marine - Checkout</title>
<link rel="stylesheet" type="text/css" href="css/form.css" />
<link rel="stylesheet" type="text/css" href="css/checkout.css" />
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
    <legend><strong>Your Personal Information</strong></legend>
    
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
          echo "<strong><a href=\"pages/login.php\" rel=\"external\">Click here to log in, then afterwards click \"Checkout\" at the top by your name.</a></strong>";
      }
      else
      {
          echo "<span class=\"infoLabel\">Name: </span>";
          echo  $salutation . " " .
          $customer_first_name . " " .
          $customer_middle_initial . " " .
          $customer_last_name . " ";
          echo "<strong>(<a href = \"pages/logout.php\" rel=\"external\">Logout as this user</a>)</strong>";
          
          echo "<br />";
          
          $sql = "SELECT customer_id, email_address, phone_number, address, town_city, county, country FROM my_customers WHERE customer_id = '".($_SESSION['customer_id'])."' LIMIT 1;";
          //echo $sql;
          $result = mysql_query($sql) or die(mysql_error());
          $row = mysql_fetch_assoc($result);
          //print_r($row);
          
          echo "<span class=\"infoLabel\">Email</span>: ".$row['email_address']." <br/>";
          echo "<span class=\"infoLabel\">Phone</span>: ".$row['phone_number']." <br />";
          echo "<span class=\"infoLabel\">Address</span>: ".$row['address']." <br />";
          echo "<input type=\"hidden\" name=\"customer_id\" value=\"".($_SESSION['customer_id'])."\" />";
          
      }
  }
  ?>
    </fieldset>
    
    <br />
    
    <fieldset>
    <legend><strong>Your Bill</strong></legend>
    
    <?php
	
	if($_SESSION['cart']) {	//if the cart isn't empty
		//show the cart
		
		echo "<table summary=\"Purchase Form - Bill\" id=\"bill\" border=\"1\">";	//format the cart using a HTML table
      
      echo "<tr class=\"title\">";
          echo "<th>Category</th>";
          echo "<th>Product</th>";
          echo "<th>Product Price</th>";
          echo "<th>Quantity</th>";
          echo "<th>Sub-Price</th>";
          echo "<th>Remove?</th>";
      echo "</tr>";

      // Get all categories into array
      $result = mysql_query("SELECT category_name FROM my_categories;");
      $allCategories = Array();
      while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
          $allCategories[] =  $row['category_name'];  
      }

			//iterate through the cart, the $product_id is the key and $quantity is the value
			foreach($_SESSION['cart'] as $product_id => $quantity) {	
				
				//get the name, description and price from the database - this will depend on your database implementation.
				//use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
				$sql = sprintf("SELECT product_name, category_id, retail_price FROM my_products WHERE product_id = %d;", $product_id); 
					
				$result = mysql_query($sql);
				
				//Only display the row if there is a product (though there should always be as we have already checked)
				if(mysql_num_rows($result) > 0) {
				
					list($product_name, $category_id, $price) = mysql_fetch_row($result);
				
					$line_cost = $price * $quantity * 1.0;		//work out the line cost
					$total = $total + $line_cost;			//add to the total cost
				
					echo "<tr>";
            echo "<td class=\"name\">".$allCategories[$category_id-1]."</td>";
						echo "<td class=\"name\">$product_name</td>";
						echo "<td class=\"price\">$$price</td>";
						echo "<td class=\"quantity\"><input class=\"quantity\" type=\"number\" onchange=\"updateCart('changeQuantity','$product_id&newQuantity='+parseInt(this.value),'pages/checkout.php'); \" value='$quantity'></input></td>";
						echo "<td class=\"price\" >$".(number_format((float)$line_cost, 2, '.', ''))."</td>";
						echo "<td><input class=\"removeFromCart\" type=\"button\" onclick=\"updateCart('changeQuantity','$product_id&newQuantity=0','pages/checkout.php'); \" value=\"Remove\" /></td>";
					echo "</tr>";
					
				}
			
			}
			
			// Calculate tax and final total
			$tax = number_format((0.15*$total),2,'.', '');
			$totalWithTax = ($total + $tax);
			
			if ( !( isset($_SESSION['taxExempted'] )) )
      {
        $_SESSION['taxExempted'] = "0";
      }
      
      $taxStyle = "text-decoration: none;";
      if ($_SESSION['taxExempted'] == "true")
      {
        $totalWithTax = $total; // No tax included.
        $taxStyle = "text-decoration: line-through;";
      }
			
			// Show the total
			echo "<tr><td colspan=\"6\"></td></tr>";
      echo "<tr><td class=\"price\" colspan=\"4\">Total (before tax)</td>";
      echo "<td colspan=\"1\" class=\"price\">$".(number_format((float)$total, 2, '.', ','))."</td></tr>";
      echo "<tr class=\"tax\">";
      echo "<td colspan=\"3\" class=\"name\"><label for=\"taxExempt\">Are you applicable for tax-exemption? Check for yes.</label> ";
      echo "<input type=\"checkbox\" id=\"taxExempt\" name=\"taxExempt\" ".(($_SESSION['taxExempted']=="true")?"checked=\"checked\"":"")." onclick=\"updateSession('taxExempted',this.checked, 'pages/checkout.php');\" /> </td>";
      echo "<td colspan=\"1\" style=\"$taxStyle\" class=\"tax price\">Tax</td>";
      echo "<td colspan=\"1\" style=\"$taxStyle\" class=\"tax price\">$".(number_format((float)$tax, 2, '.', ','))."</td>";
      echo "</tr><tr>";
      echo "<td colspan=\"4\" class=\"price\">Net Total</td>";
      echo "<td colspan=\"2\" class=\"price\"><strong>$".(number_format((float)$totalWithTax, 2, '.', ','))."</strong></td></tr>";
      /*
			echo "<tr>";
				echo "<td colspan=\"5\" align=\"right\">Total</td>";
				echo "<td align=\"right\" class=\"price\" >$".(number_format((float)$total, 2, '.', ''))."</td>";
			echo "</tr>";
			*/
			//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation
			echo "<tr class=\"title\">";
			  echo "<td style=\"text-align: center;\" colspan=\"6\"><a href=\"pages/products.php\">Continue Shopping</a></td>"; 
			echo "</tr>";
		echo "</table>";
	} else {
		//otherwise tell the user they have no items in their cart
		echo "<div id=\"noCart\">You have no items in your shopping cart.</div>";
		//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation
		echo "<div><a href=\"pages/products.php\">Continue Shopping</a></div>";
			
	}
	
	//function to check if a product exists
	function productExists($product_id) {
			//use sprintf to make sure that $product_id is inserted into the query as a number - to prevent SQL injection
			$sql = sprintf("SELECT * FROM my_products WHERE product_id = %d;", $product_id); 
				
			return mysql_num_rows(mysql_query($sql)) > 0;
	}

	?>
    </fieldset>

    </form>
    
    <br />
    
    <form id="purchaseForm" action="scripts/processPurchase.php" method="post" onsubmit="">
    
    <fieldset>
    <legend><strong>Submit</strong></legend>
    <span>You will receive a confirmation email and a receipt for your purchase. Thank you for your business!</span>
    <input type="submit" id="submitCheckout" value="I hereby accept the terms and the bill price. Purchase Now!" />
    
    </fieldset>
    
    </form>

              </div>
           </div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>


</body>
</html>
