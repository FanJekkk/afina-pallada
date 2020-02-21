<?php
	
    include("include/db_connect.php");
    include("functions/functions.php");
    $id1 = clear_string($_GET["id"]);
    session_start();
    If ($id1 != $_SESSION['countid'])
    {
        $querycount = mysql_query("SELECT count FROM directory where id_direct='$id1'",$link);
        $resultcount = mysql_fetch_array($querycount);
        
        $newcount = $resultcount["count"] + 1;
        $update = mysql_query ("UPDATE directory SET count='$newcount' WHERE id_direct='$id1'", $link);
    }
    $_SESSION['countid'] = $id1;
     session_start();
    include("include/auth_cookie.php");
?>
<!DOCTYPE html PUBLIC "-//W1C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
 
<link href="css/reset.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
 
 <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
 <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
 <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
  <script type="text/javascript" src="/js/shop-script.js"></script>
 <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
 <title>Туристический центр "АФИНА-ПАЛЛАДА"</title>
</head>

<body>

<div id="block-body">
<?php
 
if ($_SESSION['auth'] == 'yes_auth')
{
  
 echo '<p id="auth-user-info" align="right">Здравствуйте, '.$_SESSION['auth_name'].'!</p>

<button type="submit" name="exit" id="exit"><a href="/logout.php">Выйти</a></button>
<p id="block-basket"><a href="cart.php?action=oneclick">Корзина пуста</a></p>';   
     
}else{
  
  echo '<p id="reg-auth-title" align="right"><a class="top-auth">Вход/Регистрация</a></p>';   
     
}?>
<div id="block-search1">

<form method="GET" action="search.php?q=" >
<input type="text" id="input-search" name="q" value="Поиск туров и экскурсий" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><span id="span1"></span>
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
<ul id="block-tur">
<?php
$result2 = mysql_query("SELECT * FROM directory where id_direct='$id1' AND id_type='0'",$link);
 if (mysql_num_rows($result2) > 0)
 {
    $row2 = mysql_fetch_array($result2);
    do
    {
        echo '
        <div id="block_content_info">
        <p id="navi"><a href=tur.php>Туры</a> \ <span>'.$row2["title"].'</span></p>
        </div>
        <div id="block-info">
        <div id="block_content_ecs">
        <img src="/list_image/'.$row2["image"].'"/>
        </div>
        <ul class = "counts-list">
        <li><img src="/images/count.png"/><p>'.$row2["count"].'</p></li>
        </ul>                                           
        <div id="block-description">
        <p id="content-title"><a "'.$row2['id_direct'].'">'.$row2["title"].'</a></p>
        <p id="list-description">'.$row2["large_description"].'</p>
        <div id="price1">'.$row2["price"].'</div>
        </div>
        </div>
        ';
        }
  while($row2 = mysql_fetch_array($result2));
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