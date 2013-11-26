<?php 
$con = mysql_connect("localhost","csc35523","9shnejou"); 
if (!$con) {   die('Could not connect: ' . mysql_error()); } 
mysql_select_db("csc35523", $con); 
$sql = stripslashes($_POST['query']);
# $result = mysql_query("SELECT COUNT(visit_id) as visit_count, DATE_FORMAT(date_time,'%Y-%m-%d') as visit_day, DATE_FORMAT(date_time,'%Y-%m-%d-%H') as visit_hour, DATE_FORMAT(date_time, '%W, %M %d, %Y %H:00:00') as visit_stamp FROM my_visits WHERE action = 'arrived' GROUP BY visit_stamp HAVING visit_day = DATE_FORMAT(CURDATE(), '%Y-%m-%d') ORDER BY visit_hour;"); 
//echo "sql:".$sql;
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)) 
{   
echo $row['visit_stamp'] . "\t" . $row['visit_count']. "\n"; 
} 
mysql_close($con); 
?>
