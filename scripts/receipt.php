<?php
function displayReceipt($customer_id)
{
    $items = getExistingOrder($customer_id);
    $numRecords = mysql_num_rows($items);
    if($numRecords == 0)
    {
        echo "<p><strong>Your shopping cart is empty.</strong></p>
            <p><a class='noDecoration' 
            href='estore.php'><strong>Please click here
            to continue shopping ...</strong></a></p>";
    }
    else
    {
        displayHeader();
        $grandTotal = 0;
        $row = mysql_fetch_array($items);
        $order_id = $row[order_id];
        $grandTotal += displayItem($row);
        for($i = 1; $i < $numRecords; $i++)
        {
            $row = mysql_fetch_array($items);
            $grandTotal += displayItem($row);
        }
        displayFooter($grandTotal);
    }
}

function getExistingOrder($customer_id)
{
    $query = "SELECT
        Orders.order_id,
        Orders.customer_id,
        Orders.order_status_code,
        Order_Items.*
        FROM Order_Items,Orders WHERE
        Orders.order_id=Order_Items.order_id and
        Orders.order_status_code='IP' and
        Orders.customer_id = '$customer_id';";
    $items = mysql_query($query)
        or die(mysql_error());
    return $items;
}


function displayHeader()
{
    echo "<p class='receipt'><strong>***** R E C E I P T *****</strong></p>
      <p><strong>Payment received from $_SESSION[customer_first_name]
      $_SESSION[customer_middle_initial] $_SESSION[customer_last_name] on "
      .date("F j, Y")." at ".date('g:ia').".</strong></p>";
    echo "<table border='1px' cellpadding='2px' class='center'>";
    echo "<tr>
        <td align='center'><strong>Product Image</strong></td>
        <td align='center'><strong>Product Name</strong></td>
        <td align='center'><strong>Price</strong></td>
        <td align='center'><strong>Quantity</strong></td>
        <td align='center'><strong>Total</strong></td>
        </tr>";
}

function displayFooter($grandTotal)
{
    echo "<tr><td colspan='4'><strong>Grand Total</strong></td>";
    printf("<td align='right'>\$%.2f</td></tr>", $grandTotal);
    echo "<tr><td colspan='5'>
        <p><strong>Your order has been processed.<br />
        Thank you very much for shopping with Nature's Source.<br />
        We appreciate your purchase of the above product(s).<br />
        You may print a copy of this page for your permanent record.<br />
        <a href='estore.php' class='noDecoration'>Please click here
        to return to the e-store home page.</a><br />
        Or you can choose any one of the navigation
        links provided in the menu.</strong></p>
        <p>Note to readers of the text:<br />We have only
        marked the order and corresponding items as paid.<br />
        We have also reduced the inventory in the Products table.<br />
        Actual handling of payments and shipment is beyond
        the scope of our book.</p>
        </td></tr></table>";
}

function displayItem($row)
{
    $prod = $row[product_id];
    $prod = stripslashes($prod);
    $query = "SELECT * FROM Products WHERE product_id = $prod;";
    $product = mysql_query($query)
        or die(mysql_error());
    $rowProd = mysql_fetch_array($product);
    echo "<tr><td align = center>\n";
    echo "<img height='70' width='70'
        src=\"".$rowProd[product_image_url]."\" />";
    echo "</td><td>";
    echo $rowProd[product_name];
    echo "</td><td align='right'>";
    printf("$%.2f\n",$rowProd[product_price]);
    echo "</td><td align='center'>";
    echo $row[order_item_quantity];
    echo "</td><td align='right'>";
    $total = $row[order_item_quantity]*$row[order_item_price];
    printf("$%.2f", $total);
    echo "</td></tr>";
    return $total;
}


/*
function displayHeader()
{
    echo "<p align = center><b>Receipt</b></p>";
    echo "<table border = 1 cellspacing = 0 cellpadding = 2>\n";
    echo "<tr>\n<td>\nProduct Image\n</td>\n
        <td>\nProduct name\n</td>\n<td>\nPrice\n</td>\n
        <td>\nQuantity\n</td>\n<td>\nTotal\n</td>\n
        </tr>\n";
}

function displayFooter($grandTotal)
{
    echo "<tr>\n<td colspan=4>Grand Total</td>\n";
    printf("<td>\$%.2f</td></tr>\n",$grandTotal);
    echo "<tr><td colspan=5>
        <p>Thank you very much for shopping with us.
        Your order has been processed.
        <a href = \"estore.php\"> Please click here
        to return to the e-store home page. </a>
        Or you can choose any one of the navigation
        links provided in the menu.</p>
        <p>Note to the readers of the book: We have only
        marked the order and corresponding items as paid.
        We also reduce the inventory in Products table.
        Actual handling of payments and shipment is beyond
        the scope of this book.</p>
        </td></tr></table>\n";
}

function displayItem($row)
{
    $prod = $row[product_id];
    $prod = stripslashes($prod);
    $query = "SELECT * FROM Products WHERE product_id = $prod;";
    $product = mysql_query($query)
        or die(mysql_error());
    $rowProd = mysql_fetch_array($product);
    echo "<tr>\n";
    echo "<td align = center>\n";
    echo  "<img height = 70 width = 70
        src = \"".$rowProd[product_image_url]."\" />\n";
    echo "</td>\n";
    echo "<td>\n";
    echo $rowProd[product_name] . "\n";
    echo "</td>\n";
    echo "<td>\n";
    printf("$%.2f\n",$rowProd[product_price]);
    echo "</td>\n";
    echo "<td>\n";
    echo $row[order_item_quantity] . "\n";
    echo "</td>\n";
    echo "<td>\n";
    $total = $row[order_item_quantity]*$row[order_item_price];
    printf("$%.2f", $total);
    echo "</td>\n";
    echo "</tr>\n";
    return $total;
}
*/
?>
