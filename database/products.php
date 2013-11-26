<?php

include("../scripts/db.php");

header("Content-Type: text/xml");

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";

// Get all categories into array
// build Categories list
$sql = "SELECT category_id, category_name FROM my_categories ORDER BY category_id ASC;";
$allCategories = mysql_query($sql);

// Print out XML database file.
echo "<DATABASE>";

while(list($cat_id,$category_name) = mysql_fetch_row($allCategories))
{
    echo "<CATEGORY>";
    echo "<CATNAME>".$category_name."</CATNAME>";
    echo "<CATID>".$cat_id."</CATID>";
    
    $sql = "SELECT product_id, product_name, imgsrc, retail_price FROM my_products WHERE category_id = '$cat_id' ORDER BY product_id;";       
    $allProducts = mysql_query($sql);

    while(list($prod_id, $name, $imagesrc, $price) = mysql_fetch_row($allProducts)) 
    {
        
        //$imagesrc = "aps2.6.gif";
        $description = "Technical Info: <br />
            OverallLength: 25 in <br />
            Overall Width: 13.5 in <br />
            Overall Height: 39.9 in (44.9 Long Shaft) <br />
            Weight: 17 kg / 37.4 lbs (18 kg / 39.6 lbs Long Shaft) <br />
            Full Throttle Operating Range: 5250-5750 r/min <br />
            Maximum Output: 1.9(2.6)@5500 <br />
            Engine Type: OHV <br />
            Displacement (cc): 72 <br />
            Bore x Stroke: 2.13x1.24 in. <br />
            Ignition System: TCI <br />
            Control System: Tiller  <br />
            Rear Positions: For./Neut. <br />
            Gear Ratio: 2.08 (27/13) <br />
            Trim & Tilt System: Manual <br />
            Fuel Tank Capacity: Integral 1.2 L / 0.312 gal <br />
            Engine Oil Cap. (w/o oil filter): 0.35 L / 0.091 gal <br />
            Propeller Options: 3-7 1/4 x 6  <br />";
        
        echo "<PRODUCT>";
        echo "<PRODID>".$prod_id."</PRODID>";
        echo "<PRODNAME>".$name."</PRODNAME>";
        echo "<PRICE>".$price."</PRICE>";
        echo "<IMGSRC>".$imagesrc."</IMGSRC>";
        echo "<DESCR>"."<![CDATA[".$description."]]>"."</DESCR>";

        echo "</PRODUCT>";
    }

    echo "</CATEGORY>";
}

echo "</DATABASE>";

?>
