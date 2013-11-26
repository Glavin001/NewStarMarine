<?php
//displayCategory.php
$cat = stripslashes($cat);
$query = "SELECT * FROM Products WHERE
    product_category_code = $cat
    ORDER BY product_name ASC";
$category = mysql_query($query)
    or die(mysql_error());
$numRecords = mysql_num_rows($category);
echo "<p><a class=\"noDecoration\" 
    href='department.php'><strong>Click here to return to
    product category listing</strong></a></p>";
echo "<table border='4px'>";
echo "<tr><td align='center'><strong>Product Image</strong></td>
    <td align='center'><strong>Product Name</strong></td>
    <td align='center'><strong>Price</strong></td>
    <td align='center'><strong>Quantity in Stock</strong></td>
    <td align='center'><strong>Purchase?</strong></td></tr>";
for ($i = 0; $i < $numRecords; $i++)
{
    echo "<tr>";
    $row = mysql_fetch_array($category);
    echo "<td align='center'>";
    echo  "<img height='70px' width='70px'
        src='".$row["product_image_url"]."'
        alt='Product Image' />";
    echo "</td><td>";
    echo $row["product_name"];
    echo "</td><td align='center'>";
    printf("$%.2f",$row["product_price"]);
    echo "</td><td align='center'>";
    echo $row["product_inventory"];
    echo "</td><td align='center'>";
    echo "<a href=\"purchase.php?prod='".$row["product_id"]."'\">";
    echo "<img src='images/buythisitem.png' alt='Buy this item' /></a>";
    echo "</td></tr>";
}
echo "</table>";
?>
