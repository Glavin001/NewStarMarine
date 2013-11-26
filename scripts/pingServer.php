<?php
  // pingServer.php
    
  if (($_GET['onload'] == "true") or ($_GET['onunload'] == "true"))
  {
  
    // Visitor info
    $visitorAddress = getenv("REMOTE_ADDR");
    $page = $_GET['page'];
    $action = "";
    
    if ($_GET['onload'] == "true")
    {
      // On page load
      $action = "arrived";  
    }
    else if ($_GET['onunload'] == "true")
    {
      // On page unload
      $action = "left";
    }
    
    $con = mysql_connect('localhost', 'csc35523', '9shnejou');
    if (!$con)
    {
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("csc35523", $con);
    $sql = "INSERT INTO `csc35523`.`my_visits` (`visit_id`, `date_time`, `ip_address`, `page`, `action`) VALUES (NULL, CURRENT_TIMESTAMP, '".$visitorAddress."', '".$page."', '".$action."');";
    $result = mysql_query($sql); 
    
  }

  // Not on page load
  $msg = "Our time is " . date('l, F, jS h:i:s A');
  //$msg = "Mark sucks dick";
  echo $msg;
  
?>
