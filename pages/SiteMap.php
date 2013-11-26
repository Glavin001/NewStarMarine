<?PHP include("../common/top.php"); ?>

<!-- SiteMap.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Site Map</title>
<?PHP include("../common/base.php"); ?>
</head>

<body>
<div id="page">
            
            <?PHP include("../common/body_head.php"); ?>
            
            <?PHP include("../common/mainmenu.php"); ?>           
            
            <div id="content">
              <div id="text">
                
<h3>Site Map:</h3>

<!-- mainmenu.html -->
<ul class="normalList">
<li>
Top level
<ul class="normalList">

<li>
<a href="my_business.php">Home</a>
</li>
<li>
<a href="pages/AboutNewStarMarine.php">About NewStar Marine</a>
</li>
<li>
<a href="pages/AboutOurSuppliers.php">About Our Suppliers</a>
</li>
<li>
<!-- <a href="pages/NewProducts.php">New Products</a> -->
<a href="javascript:void(0)" onclick="updateSession('displayCategory','0',''); updateSession('productCondition','new', 'pages/products.php?productCondition=new');" onmouseover="show('m4')">New Products</a>
</li>
<li>
<!-- <a href="pages/PreOwnedProducts.php">Pre-Owned Products</a> -->
<a href="javascript:void(0)" onclick="updateSession('displayCategory','0',''); updateSession('productCondition','preowned', 'pages/products.php?productCondition=preowned');" onmouseover="show('m5')">Pre-Owned Products</a>
</li>
<li>
<a href="pages/PartsAccessories.php">Parts &amp; Accessories</a>
</li>
<li>
<a href="pages/checkout.php">Checkout</a>
</li>
<li>
<a href="pages/OrderPartsAccessForm.php">Order Parts &amp; Accessories Form</a>
</li>
<li>
<a href="pages/Rentals.php">Rentals</a>
</li>
<li>
<a href="pages/Gallery.php">Gallery</a>
</li>
<li>
<a href="pages/Testimonials.php">Testimonials</a>
  <ul class="normalList">
    <li>
    <a href="pages/SubmitTestimonialForm.php">Submit Testimonial Form</a>
    </li>
  </ul>
</li>
<li>
<a href="pages/RelatedLinks.php">Related Links</a>
</li>
<li>
<a href="pages/ContactUs.php">Contact Us</a>
  <ul class="normalList">
    <li>
    <a href="pages/FeedbackForm.php">Feedback Form</a>
    </li>
  </ul>
</li>

</ul>
</li>
</ul>

            </div>
            </div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>

</body>
</html>
