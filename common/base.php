<!-- base.html -->
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<?php
// base.php
echo "<!-- base.php -->";
echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';

/* FIXED BUG: Was using getcwd(), get current working directory, which does not function properly in some cases. */
// Directory of this base.php file. Should be either at top directory of website, ./submission09/base.php, or within the common directory, ./submission09/common/base.php
$dir=dirname(__FILE__); // Solution!

// Get rid of 'public_html' directory and all of it's parent directories.
$parentdir='/public_html/';
list($begin, $end)=explode($parentdir, $dir);
// Get rid of the 'common' directory, for which this base.php resides.
$subdir='/common';
list($middle, $end)=explode($subdir, $end);
// return current working directory
$bDir=$middle;
echo '<base href="http://cs.smu.ca/~g_wiechert/'.$bDir.'/" />';
?>

<link rel="stylesheet" type="text/css" href="css/default.css" />

<!-- jQuery-->
<script type="text/javascript" src="scripts/jquery/jquery-1.8.2.min.js"></script>
<script type="text/javascript"   
   src="scripts/jquery/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jqFancyTransitions.1.8.min.js"></script>
<!--Glavin's Scripts-->
<script type="text/javascript" src="scripts/menu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<!-- <script type="text/javascript" src="scripts/rotateImages.js"></script> -->
<!-- <script type="text/javascript" src="scripts/formEffects.js"></script> -->
<!-- <script type="text/javascript" src="scripts/dynamicResize.js"></script> -->
<!-- <script type="text/javascript" src="scripts/highcharts/highcharts.js"></script> -->
