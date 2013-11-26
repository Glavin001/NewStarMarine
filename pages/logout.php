<?php
//logout.php
session_start();
if ($_SESSION["customer_id"] == "") $notLoggedIn = true;
session_unset();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>NewStar Marine - Logging Out</title>
    <?PHP include("../common/base.php"); ?>
  </head>
  <body>
    <div id="page">
             
      <?PHP include("../common/body_head.php"); ?>
      <?PHP include("../common/mainmenu.php"); ?>           

      <div id="content">
        <div id="textOnly" class="FeedbackForm">
        <?php if ($notLoggedIn) { ?>
        <p>Thank you for visiting Nature's Source.<br />
        You have not yet logged in.</p>
        <p><a href="pages/login.php" class="noDecoration"> Click here if you wish to
          log in.</a></p>
        <p><a href="pages/products.php" class="noDecoration"> Click here to browse
          our product catalog.</a></p>
        <?php } else { ?>
        <p>Thank you for visiting our e-store.<br />
        You have successfully logged out.</p>
        <p><a href = "pages/login.php" class="noDecoration"> Click here if you wish
          to log back in.</a></p>
        <p><a href = "department.php" class="noDecoration"> Click here to
          browse our product catalog.</a></p>
        <?php } ?>
        </div>
      </div>
    <?PHP include("../common/footer.php"); ?>
    </div>
  </body>
</html>
