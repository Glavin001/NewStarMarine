<?PHP
session_start();
echo session_id();

if (isset($_POST['name']) && isset($_POST['value']) )
{
  
  // Get _SESSION variable name and value.
  $name = $_POST['name'];
  $value = $_POST['value'];
  
  // Process this.
  $_SESSION[$name] = $value;
  
  #echo "Success: \$_SESSION['$name']=";
  #echo $_SESSION[$name];
}

?>