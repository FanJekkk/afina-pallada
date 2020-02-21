<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
include("db_connect.php");
include("../functions/functions.php");
session_start();
         
$id = clear_string($_POST["id"]);

$result = mysql_query("SELECT * FROM journal_app WHERE login = '{$_SESSION['auth_login']}' AND cart_id_product = '$id'",$link);

If (mysql_num_rows($result) > 0)
{
    $result2 = mysql_query("SELECT * FROM journal_app WHERE cart_id_product = '$id'",$link);
     $row2 = mysql_fetch_array($result2);
     
           mysql_query("INSERT INTO cat_app(id_direct,id_app,login)
                        VALUES( 
                            '".$row2['cart_id_product']."',
                            '".$row2['id_app']."',
                            '".$_SESSION['auth_login']."'                                                                       
                            )",$link);  
$row = mysql_fetch_array($result);    
$new_count = $row["cart_count"] + 1;
$update = mysql_query ("UPDATE journal_app SET cart_count='$new_count' WHERE login = '{$_SESSION['auth_login']}' AND cart_id_product ='$id'",$link);   
}
else
{
    $result = mysql_query("SELECT * FROM directory,users WHERE id_direct = '$id'",$link);
    $row = mysql_fetch_array($result);
     
           mysql_query("INSERT INTO journal_app(cart_id_product,cart_price,cart_datetime,login,id)
                        VALUES( 
                            '".$row['id_direct']."',
                            '".$row['price']."',                    
                            NOW(),
                            '".$_SESSION['auth_login']."',
                            '".$_SESSION['auth_id']."'                                                                       
                            )",$link);  
     $result2 = mysql_query("SELECT * FROM journal_app WHERE cart_id_product = '$id'",$link);
     $row2 = mysql_fetch_array($result2);
     
           mysql_query("INSERT INTO cat_app(id_direct,id_app,login)
                        VALUES( 
                            '".$row2['cart_id_product']."',
                            '".$row2['id_app']."',
                            '".$_SESSION['auth_login']."'                                                                          
                            )",$link);  
}
}
?>