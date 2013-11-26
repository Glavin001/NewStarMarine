<?PHP include("../common/top.php"); ?>

<!-- registration.php -->
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>NewStar Marine - Registration</title>
    <?PHP include("../common/base.php"); ?>
    <?php include "../scripts/db.php"; ?>
  </head>
  <body>
    <div id="page">
      <?PHP include("../common/body_head.php"); ?>
            
      <?PHP include("../common/mainmenu.php"); ?>           
            
      <div id="content">
        <div id="textOnly" class="FeedbackForm">
        <?php include "../scripts/processRegistration.php"; ?>
        </div>
      </div>
      <?PHP include("../common/footer.php"); ?>
    </div>
  </body>
</html>
