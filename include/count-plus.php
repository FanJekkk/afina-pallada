<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
include("db_connect.php");
include("../functions/functions.php");
 session_start();
$id = clear_string($_POST["id"]);
 
$result = mysql_query("SELECT * FROM journal_app WHERE id_app = '$id' AND login = '{$_SESSION['auth_login']}'",$link);
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);    
$new_count = $row["cart_count"] + 1;
$update = mysql_query ("UPDATE journal_app SET cart_count='$new_count' WHERE id_app='$id' AND login = '{$_SESSION['auth_login']}'",$link);
echo $new_count;    
}
}
?>