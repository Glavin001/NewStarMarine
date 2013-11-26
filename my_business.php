<?PHP include("common/top.php"); ?>

<!-- my_business.html -->

<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <title>NewStar Marine - Home</title>
        <?PHP
        include("common/base.php");
        ?>
        <script type="text/javascript" src="scripts/rotateImages.js"></script>
        <!-- <script type="text/javascript" src="scripts/productShowcase.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            var container = document.getElementById("rotationBox");
            var showCase = new showcase(container);
            showCase.load("database/products.php");
            showCase.startRotation();
            //setInterval(showCase.rotate,showCase.rotationPeriod);
          });
        </script> -->
    </head>

    <body onload="startRotation();" > 
        <div id="page">
            
            <?PHP
            include("common/body_head.php");
            include("common/mainmenu.php");            
            ?>
            
            <div id="content">
              <div id="text">
                
                <h3>Home:</h3>

                <div id="rotationBox">
                <input type="hidden" id="rBox-Legend"></input>
                <!-- <button onclick="prevImage()">Previous</button><button onclick="toggleImage()">Toggle Rotation</button><button onclick="nextImage()">Next</button> -->
                <img id="rBox-Img" alt="Rotating Images" src="" width="150" height="180" />
                <input type="hidden" id="rBox-Desc"></input>
                </div>
                
                <p>
                NewStar Marine believes that &ldquo;<em>a picture's worth a 
                thousand words,</em>&rdquo; and so our home page is mainly 
                comprised of images/videos of our products in action!
                For more information about us please visit our 
                <a href="pages/AboutNewStarMarine.php">
                &lsquo;About Us&rsquo;</a>
                 page and our other pages.
                </p>
                
                <div style="text-align: center;">
<object 
type="application/x-shockwave-flash" width="853" height="480"
data="http://www.youtube.com/v/Luvq0ku-gNY?version=3&amp;hl=en_US">
<param name="movie"
value="http://www.youtube.com/v/Luvq0ku-gNY?version=3&amp;hl=en_US" />
</object>
                </div>
                
              </div>
            </div>
            
            <br />
            
            <?PHP
            include("common/footer.php");
            ?>
            
            <br />
            
        </div>

    </body>

</html>
