<?PHP include("../common/top.php"); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>NewStar Marine - New Products</title>
<?PHP include("../common/base.php"); ?>
<meta name="description" content="PHP Shopping Cart Using Sessions" /> 
<meta name="keywords" content="shopping cart tutorial, shopping cart, php, sessions" />
<link rel="stylesheet" type="text/css" href="css/estore.css" />

<?PHP include("../scripts/db.php"); ?>

</head>

<body>

<div id="page">
            
            <?PHP include("../common/body_head.php"); ?>
            
            <?PHP include("../common/mainmenu.php"); ?>          
            
            <div id="content">
              <div id="text">

<div id="leftMenu">

<div id="categoryMenu" class="leftPanel">
<strong class="title">Categories</strong>
<ul>

	<?php
	
		// Setup session variables
		if ( !( isset($_SESSION['displayCategory'] )) )
		{
			$_SESSION['displayCategory'] = "0";
		}
		if ( !( isset($_SESSION['productCondition'] )) )
		{
			$_SESSION['productCondition'] = "all";
		}
		if ( !( isset($_SESSION['orderBy'] )) )
		{
			$_SESSION['orderBy'] = "product_name";
		}
		if ( !( isset($_SESSION['displayProduct'] )) )
		{
			$_SESSION['displayProduct'] = "0";
		}
		
		// build Categories list
		$current_category = "All Products";
		$sql = "SELECT category_id, category_name FROM my_categories ORDER BY category_name ASC;";
		$result = mysql_query($sql);
		
		// Build list
		$isSelected = False;
		if ($_SESSION['displayCategory'] == 0) 
		{ $isSelected=True; }
		else { $isSelected=False;}
    	echo "<li>".(($isSelected)?"<b>":"")."<a href=\"javascript:void(0)\" onclick=\"updateSession('displayCategory',0, 'pages/products.php'); \" >All Products</a>".(($isSelected)?"</b>":"")."</li>";
		
		while(list($id, $category_name) = mysql_fetch_row($result)) {
			if ($_SESSION['displayCategory'] == $id) 
				{ $isSelected=True; }
				else { $isSelected=False;}
			echo "<li>";
			  echo ($isSelected)?"<b>":"";
			  echo "<a href=\"javascript:void(0)\" onclick=\"updateSession('displayCategory',$id, 'pages/products.php');\" >";
				//echo "<td>$id</td>";
				echo "$category_name";
				//echo "<td><a href=\"cart.php?action=add&id=$id\">Add To Cart</a></td>";
			  echo "</a>";
			  echo ($isSelected)?"</b>":"";
			echo "</li>";

			if (isset($_SESSION['displayCategory']) && ($id == $_SESSION['displayCategory']) )
			{
			  $current_category = $category_name;
			}
			
		}
		
	?>
</ul>
</div>
<br />
<div id="cart" class="leftPanel">

<strong class="title">Current Cart</strong>

	<?php
	
	if($_SESSION['cart']) {	//if the cart isn't empty
		//show the cart
		
		echo "<table border=\"1\">";	//format the cart using a HTML table
      
      echo "<tr class=\"title\">";
          echo "<th>Item</th>";
          echo "<th>Quantity</th>";
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
						echo "<td align=\"left\" class=\"name\" >";
						echo "<button class=\"removeItem\" onclick=\"updateCart('changeQuantity','$product_id&newQuantity=0','pages/products.php'); \" >X</button>";
						echo " $name ";
						echo "</td>";
						
						echo "<td align=\"center\" class=\"quantity\">";
						echo "<input class=\"quantity\" type=\"number\" onchange=\"updateCart('changeQuantity','$product_id&newQuantity='+parseInt(this.value),'pages/products.php'); \" value='$quantity' ></input>";
						echo "</td>";
						
						echo "<td align=\"center\" class=\"price\" >$".(number_format((float)$line_cost, 2, '.', ''))."</td>";
					echo "</tr>";
					
				}
			
			}
			
			//show the total
			echo "<tr>";
				echo "<td colspan=\"2\" align=\"right\" class=\"price\">Sub-Total<br />(Checkout for full total)</td>";
				echo "<td align=\"right\" class=\"price\" >$".(number_format((float)$total, 2, '.', ''))."</td>";
			echo "</tr>";
			
			//show the empty cart link - which links to this page, but with an action of empty. A simple bit of javascript in the onlick event of the link asks the user for confirmation
			echo "<tr class=\"title\">";
			  	/* echo "<td align=\"center\"><a href=\"pages/cart.php\">View Cart</a></td>";  */
				echo "<td colspan=\"1\" align=\"center\"><a href=\"javascript:void(0)\" onclick=\"if ( confirm('Are you sure you want to empty your cart?') ) updateCart('empty','', 'pages/products.php');\">Empty Cart</a></td>";
			/*
			echo "</tr>";		
			
			echo "<tr>"; */
			echo "<td colspan=\"2\" align=\"center\" >";
			echo "<a href=\"pages/checkout.php\">Checkout</a>";
			echo "</td>";
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

</div>

</div>

<div id="catalog">
<strong class="title"><?PHP echo $current_category; ?></strong>

<table border="1">

	<?php
		
    $inventory = "new_inventory"; // New Inventory by default
    if (isset($_SESSION['productCondition']))
		{
      // Condition set
      $condition = $_SESSION['productCondition'];
      if ($condition == "new")
      {
        $inventory = "new_inventory"; // New Inventory by default
		  }
		  else if ($condition == "preowned")
		  {
        $inventory = "pre_owned_inventory"; // New Inventory by default
		  }
		
		}
		
    $sql = "SELECT product_id, product_name, $inventory, retail_price FROM my_products";
		if (isset($_SESSION['displayCategory']))
		{
      // Category set
      $cat_num = $_SESSION['displayCategory'];
      if ($cat_num != 0)
      {
        $sql .= " WHERE category_id = $cat_num";
      }
      else
      {
        $sql .= " WHERE category_id > 0";
      }
		}
		else
		{
		  $cat_num = 0;
		}
		
		if (isset($_SESSION['productCondition']))
		{
      // Condition set
      $condition = $_SESSION['productCondition'];
      if ($condition == "new")
      {
        $sql .= " ".((isset($_SESSION['displayCategory']))?"AND":"WHERE")." new_inventory > 0";        
		  }
		  else if ($condition == "preowned")
		  {
		    $sql .= " ".((isset($_SESSION['displayCategory']))?"AND":"WHERE")." pre_owned_inventory > 0";		    
		  }
		}
		
		// Order By
		$orderBy = $_SESSION['orderBy'];
		$sql .= " ORDER BY $orderBy";
		
		$orderDirection = "ASC";
		$sortArrow = "&#9660;";
		if (strpos($orderBy,'ASC') !== false)
		{
		  $orderDirection = "DESC";
		  $sortArrow = "&#9650;";
		}
		// Finish query
		$sql .= ";";
		$result = mysql_query($sql);
		
		// Build table
		// Headers
		echo "<tr class=\"title\">";
		echo "<th><a href=\"javascript:void(0)\" onclick=\"updateSession('orderBy','product_name $orderDirection', 'pages/products.php');\" >".
		((strpos($_SESSION['orderBy'],'product_name') !== false)?$sortArrow." ":"")."Name".((strpos($_SESSION['orderBy'],'product_name') !== false)?" ".$sortArrow:"")."</a></th>";
		echo "<th><a href=\"javascript:void(0)\" onclick=\"updateSession('orderBy','$inventory $orderDirection', 'pages/products.php');\" >".
		((strpos($_SESSION['orderBy'],"$inventory") !== false)?$sortArrow." ":"")."Inventory".((strpos($_SESSION['orderBy'],"$inventory") !== false)?" ".$sortArrow:"")."</a></th>";
		echo "<th><a href=\"javascript:void(0)\" onclick=\"updateSession('orderBy','retail_price $orderDirection', 'pages/products.php');\" >".
		((strpos($_SESSION['orderBy'],'retail_price') !== false)?$sortArrow." ":"")."Price".((strpos($_SESSION['orderBy'],'retail_price') !== false)?" ".$sortArrow:"")."</a></th>";
		echo "<th>Add to Cart</th>";
		echo "</tr>";
		
		// Rows and Data
		$count = 0;
		while(list($id, $name, $category, $price) = mysql_fetch_row($result)) {
		  $count += 1;
		  if ($count%2 == 0)
		  {
			  echo "<tr class=\"odd\">";
			}
			else
			{
			  echo "<tr>";
			}
				echo "<td>$name</td>";
				echo "<td>$category</td>";
				echo "<td class=\"price\">$".$price."</td>";
				echo "<td class=\"addToCart\"><button class=\"addToCart\" onclick=\"updateCart('add','$id', '".((isset($_SESSION['customer_id']))?"pages/products.php":"pages/login.php")."');\">Add To Cart</button></td>";
			
			echo "</tr>";
		}
		
		
	?>
</table>

</div>

</div>
           </div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>

</body>
</html>
