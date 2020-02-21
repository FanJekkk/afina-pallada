<?php
	
    include("include/db_connect.php");
    include("functions/functions.php");
    require "db.php";
    session_start();
    include("include/auth_cookie.php");
        
     $id = clear_string($_GET["id"]);
     
     $action = clear_string($_GET["action"]);
    
   switch ($action) {

	    case 'clear':
        $clear2 = mysql_query("DELETE FROM cat_app WHERE login = '{$_SESSION['auth_login']}'",$link);
        $clear= mysql_query("DELETE FROM journal_app WHERE login = '{$_SESSION['auth_login']}'",$link);
        break;
         
        case 'delete':     
        $delete2 = mysql_query("DELETE FROM cat_app WHERE id_app = '$id'",$link);
        $delete = mysql_query("DELETE FROM journal_app WHERE id_app = '$id' AND login = '{$_SESSION['auth_login']}'",$link);
        break;
        
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 
 <link href="css/reset.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
  
 <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
 <script type="text/javascript" src="js/jcarousellite_1.0.1.js"></script>
 <script type="text/javascript" src="trackbar/jquery.trackbar.js"></script>
  <script type="text/javascript" src="/js/shop-script.js"></script>
 <script type="text/javascript" src="/js/jquery.cookie.min.js"></script> 
 
 <title>Корзина заказов</title>
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
     
} ?>

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


<div id="block-content1">
<?php
 $action = clear_string($_GET["action"]);
  switch ($action) {

	    case 'oneclick':
   
   echo ' 
   <div id="block-step">  
   <div id="name-step">  
   <ul>
   <li><a class="active" >1. Корзина заказов</a></li>
   <li><span>&rarr;</span></li>
   <li><a>2. Комментарии к заказам</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li> 
   </ul>  
   </div>  
   <p>шаг 1 из 3</p>
   <a href="cart.php?action=clear" id="but-clear">Очистить</a>
   </div>
';
 echo '  
   <div id="header-list-cart">    
   <div id="head1" >Изображение</div>
   <div id="head2" >Наименование заказа</div>
   <div id="head3" >Кол-во</div>
   <div id="head4" >Цена</div>
   </div> 
   ';
   
$result = mysql_query("SELECT * FROM journal_app,directory WHERE journal_app.login = '{$_SESSION['auth_login']}' AND directory.id_direct = journal_app.cart_id_product",$link);
 
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
 
$int = $row["cart_price"] * $row["cart_count"];
$all_price = $all_price + $int;
if  (strlen($row["image"]) > 0 && file_exists("./list_image/".$row["image"]))
{
$img_path = './list_image/'.$row["image"];
$max_width = 100; 
$max_height = 100; 
 list($width, $height) = getimagesize($img_path); 
 
}else
{
$img_path = "/images/noimages.jpeg";
$width = 120;
$height = 105;
} 
 
   echo '
 
<div class="block-list-cart">
 
<div class="img-cart">
<p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
</div>
 
<div class="title-cart">
<p><a href="">'.$row["title"].'</a></p>
<p class="cart-mini-features">
'.$row["large_description"].'
</p>
</div>
 
<div class="count-cart">
<ul class="input-count-style">
 
<li>
<p align="center" iid="'.$row["id_app"].'" class="count-minus">-</p>
</li>
 
<li>
<p align="center"><input id="input-id'.$row["id_app"].'" iid="'.$row["id_app"].'" class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
</li>
 
<li>
<p align="center" iid="'.$row["id_app"].'" class="count-plus">+</p>
</li>
 
</ul>
</div>
 
<div id="tovar'.$row["id_app"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($int).' руб</p></div>
<div class="delete-cart"><a  href="cart.php?id='.$row["id_app"].'&action=delete" ><img src="/images/del.png" /></a></div>
 
<div id="bottom-cart-line"></div>
</div>
 
 
';
     
}
 while ($row = mysql_fetch_array($result));
  
 echo '
 <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
 <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p> 
 ';
   
} 
else
{
    echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
}


   
	    break;
        
        case 'confirm':     
  echo ' 
   <div id="block-step">  
   <div id="name-step">  
   <ul>
   <li><a href="cart.php?action=oneclick" >1. Корзина заказов</a></li>
   <li><span>&rarr;</span></li>
   <li><a class="active" >2. Комментарии к заказам</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li> 
   </ul>  
   </div>  
   <p>шаг 2 из 3</p>
   <a href="cart.php?action=clear" >Очистить</a>
   </div>
';
 

        break;
        
        case 'completion':
          echo ' 
   <div id="block-step">  
   <div id="name-step">  
   <ul>
   <li><a href="cart.php?action=oneclick" >1. Корзина заказов</a></li>
   <li><span>&rarr;</span></li>
   <li><a href="cart.php?action=confirm" >2. Комментарии к заказам</a></li>
   <li><span>&rarr;</span></li>
   <li><a class="active">3. Завершение</a></li> 
   </ul>  
   </div>  
   <p>шаг 3 из 3</p>
   <a href="cart.php?action=clear" >Очистить</a>
   </div>
';
 

        break;
        
	    default:  

 echo ' 
   <div id="block-step">  
   <div id="name-step">  
   <ul>
   <li><a class="active" >1. Корзина заказов</a></li>
   <li><span>&rarr;</span></li>
   <li><a>2. Комментарии к заказам</a></li>
   <li><span>&rarr;</span></li>
   <li><a>3. Завершение</a></li> 
   </ul>  
   </div>  
   <p>шаг 1 из 3</p>
   <a href="cart.php?action=clear" >Очистить</a>
   </div>
';
 echo '  
   <div id="header-list-cart">    
   <div id="head1" >Изображение</div>
   <div id="head2" >Наименование заказа</div>
   <div id="head3" >Кол-во</div>
   <div id="head4" >Цена</div>
   </div> 
   ';
   
$result = mysql_query("SELECT * FROM journal_app,directory WHERE journal_app.login = '{$_SESSION['auth_login']}' AND directory.id_direct = journal_app.cart_id_product",$link);
 
If (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);   
do
{
 
$int = $row["cart_price"] * $row["cart_count"];
$all_price = $all_price + $int;
 
   echo '
 
<div class="block-list-cart">
 
<div class="img-cart">
<p align="center"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
</div>
 
<div class="title-cart">
<p><a href="">'.$row["title"].'</a></p>
<p class="cart-mini-features">
'.$row["description"].'
</p>
</div>
 
<div class="count-cart">
<ul class="input-count-style">
 
<li>
<p align="center" class="count-minus">-</p>
</li>
 
<li>
<p align="center"><input id="input-id'.$row["id_app"].'"  class="count-input" maxlength="3" type="text" value="'.$row["cart_count"].'" /></p>
</li>
 
<li>
<p align="center"  class="count-plus">+</p>
</li>
 
</ul>
</div>
 
<div id="tovar'.$row["id_app"].'" class="price-product"><h5><span class="span-count" >'.$row["cart_count"].'</span> x <span>'.$row["cart_price"].'</span></h5><p price="'.$row["cart_price"].'" >'.group_numerals($int).' руб</p></div>
<div class="delete-cart"><a href="cart.php?id='.$row["id_app"].'&action=delete" ><img src="/images/del.png" /></a></div>
 
<div id="bottom-cart-line"></div>
</div>
 
 
';
     
}
 while ($row = mysql_fetch_array($result));
  
 echo '
 <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
 <p align="right" class="button-next" ><a href="cart.php?action=confirm" >Далее</a></p> 
 ';
   
} 
else
{
    echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
}

        break;		
        
}
?>
</div>

<?php
	include("include/block-footer.php");
?>

</div>

</body>
</html>