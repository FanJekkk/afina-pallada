<?php
	include("functions/functions.php");
    include("include/db_connect.php");
    $id = clear_string($_GET["id"]);
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=windows-1251" />
 
 <link href="css/reset.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 <title>Туристический центр "АФИНА-ПАЛЛАДА"</title>
</head>

<body>

<div id="block-body">
<p id="reg-auth-title" align="right"><a href="auth.php">Вход/Регистрация</a></p>
<div id="block-search1">

<form method="GET" action="search.php?q=" >
<span></span>
<input type="text" id="input-search" name="q" placeholder="Поиск экскурсий"/>

<input type="submit" id="button-search" value="Поиск" />




</form>


</div>
</div>

<?php
	include("include/block-header.php");
?>

<?php
	include("include/block-header-bottom.php");
?>

<div id="block-content">
<ul id="block-tur-list">
 <?php
 
 if (!empty($id))
 {
    $querycat = "AND id_cat='$id'";
    
 }else
 {
    $querycat ="";  
 }
 $result1 = mysql_query("SELECT * FROM catalog where visible='1' $querycat",$link);
 if (mysql_num_rows($result1) > 0)
 {
    $row1 = mysql_fetch_array($result1);
    do
    {
        echo '
        <li>
        <div id="block_content_ecs">
        <img src="/list_image/'.$row1["images"].'"/>
        </div>
        <ul class = "counts-list">
        <li><img src="/images/count.png"/><p>'.$row1["count"].'</p></li>
        </ul>                                           
        <div id="block-description">
        <p id="content-title"><a href="view_content.php?id='.$row1["id_ecs"].'">'.$row1["ecs"].'</a></p>
        <p id="description">'.$row1["description"].'</p>
        </div>
        <div id="price"><p>'.$row1["price"].'</p></div>
        </li>
        ';
        }
  while($row1 = mysql_fetch_array($result1));
 }
 ?>

</ul>
</div>

<?php
	include("include/block-footer.php");
?>

</div>

</body>
</html>