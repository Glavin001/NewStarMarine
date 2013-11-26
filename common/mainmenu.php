<!-- mainmenu.php -->
<div id="mainMenu" onmouseout="hide()">
  <ul id="mainLinks" class="Links">
    <li>
    <a href="my_business.php" onmouseover="show('m1')">Home</a>
    </li>
    <li>
    <a href="pages/AboutNewStarMarine.php" onmouseover="show('m2')">About Us</a>
    </li>
    <li>
    <a href="pages/AboutOurSuppliers" onmouseover="show('m3')">Our Suppliers</a>
        <div id="m3" onmouseover="show('m3')">
          <a href="pages/AboutOurSuppliers.php">About Our Suppliers</a>
          <a href="http://apsoutboards.com" rel="external" >APS Outboards</a>
          <a href="http://www.tomoscanada.com" rel="external" >Tomos Canada</a>
          <a href="http://www.stright-mackay.com" rel="external" >Stright MacKay</a>
          <a href="http://www.mermaidmarine.com" rel="external" >Mermaid Marine</a>
        </div>
    </li>
    <li>
    <a href="javascript:void(0)" onclick="updateSession('displayCategory','0',''); updateSession('productCondition','new', 'pages/products.php?productCondition=new');" onmouseover="show('m4')">New Products</a>
      <!-- <div id="m4" onmouseover="show('m4')">
        <a href="pages/PurchaseForm.php">Purchase Form</a>
      </div> -->
    </li>
    <li>
    <a href="javascript:void(0)" onclick="updateSession('displayCategory','0',''); updateSession('productCondition','preowned', 'pages/products.php?productCondition=preowned');" onmouseover="show('m5')">Pre-Owned Products</a>
    </li>
    <li>
    <a href="pages/PartsAccessories.php" onmouseover="show('m6')">Parts &amp; Accessories</a>
    </li>
    <li>
    <a href="pages/Rentals.php" onmouseover="show('m7')">Rentals</a>
    </li>
    <li>
    <a href="pages/Gallery.php" onmouseover="show('m8')">Gallery</a>
      <div id="m8" onmouseover="show('m8')">
        <a href="http://www.tomoscanada.com/?id=5" rel="external" >Photos</a>
        <a href="http://www.youtube.com/user/NewStarMarine2012/videos/" rel="external" >Videos</a>
      </div>
    </li>
    <li>
    <a href="pages/Testimonials.php" onmouseover="show('m9')">Testimonials</a>
      <div id="m9" onmouseover="show('m9')">
        <a href="pages/SubmitTestimonialForm.php">Submit Testimonial</a>
      </div>
    </li>
    <li>
    <a href="pages/RelatedLinks.php" onmouseover="show('m10')">Related Links</a>
      <div id="m10" onmouseover="show('m10')">
        <a href="http://apsoutboards.com" rel="external" >APS Outboards</a>
        <a href="http://www.tomoscanada.com" rel="external" >Tomos Canada</a>
        <a href="http://www.stright-mackay.com" rel="external" >Stright MacKay</a>
        <a href="http://www.mermaidmarine.com" rel="external" >Mermaid Marine</a>
        <a href="https://salterboat.com/" rel="external">Salter Watercraft</a>
      </div>
    </li>
  </ul>
</div>
