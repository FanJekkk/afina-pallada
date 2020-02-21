<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('myeshop', true);
include('db_connect.php');
include('../functions/functions.php');
  session_start();
$result = mysql_query("SELECT * FROM journal_app WHERE login = '{$_SESSION['auth_login']}'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);
   
do
{
    $int = $int + ($row["cart_price"] * $row["cart_count"]); 
 
} while($row = mysql_fetch_array($result));
 
 
     echo group_numerals($int);
 
}
}
?>