<?PHP include("../common/top.php"); ?>

<!-- Gallery.php -->

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<title>NewStar Marine - Gallery</title>
<?PHP include("../common/base.php"); ?>
<script type="text/javascript" src="scripts/rotateImages.js"></script>
</head>

<body onload="startRotation();">
<div id="page">
            
            <?PHP include("../common/body_head.php"); ?> 
            
            <?PHP include("../common/mainmenu.php"); ?>
            
            <div id="content">
              <div id="text">
                
<h3>Gallery:</h3>

<div id="rotationBox">
<fieldset>
<legend id="rBox-Legend"><strong>Products</strong></legend>


<button onclick="prevImage()">Previous</button><button onclick="toggleImage()">Toggle Rotation</button><button onclick="nextImage()">Next</button>

<div>
<img id="rBox-Img" alt="Rotating Images" src="" width="150" height="180" />

<p id="rBox-Desc">

</p>
</div>

</fieldset>
</div>

<br />
<hr />
<br />

<h4>Links</h4>
<ul class="normalList">
<li>
<a href="http://www.tomoscanada.com/?id=5" rel="external" >Photos</a>
</li>
<li>
<a href="http://www.youtube.com/user/NewStarMarine2012/videos/" rel="external" >Video footage</a>
</li>
</ul>

<br />

</div>
</div>
<?PHP include("../common/footer.php"); ?>

            <br />
            
        </div>

</body>
</html>
