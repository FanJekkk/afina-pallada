<?php
	
    include("include/db_connect.php");
    include("functions/functions.php");
   session_start();
    include("include/auth_cookie.php");
   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
 
 <title>������������� ����� "�����-�������"</title>
</head>

<body>
<div id="block-body">
<?php
 
if ($_SESSION['auth'] == 'yes_auth')
{
  
 echo '<p id="auth-user-info" align="right">������������, '.$_SESSION['auth_name'].'!</p>

<button type="submit" name="exit" id="exit"><a href="/logout.php">�����</a></button>
<p id="block-basket"><a href="cart.php?action=oneclick">������� �����</a></p>';   
     
}else{
  
  echo '<p id="reg-auth-title" align="right"><a class="top-auth">����/�����������</a></p>';   
     
}
     
?>
<div id="block-top-auth">
<div class="corner"></div>
<form action="auth.php" method="POST">

<ul id="input-email-pass">

<h3 class="h3-title">����</h3>
<p id="message-auth">�������� ����� ��� ������</p>

<li><center><input type="text" id="auth_login" placeholder="����� ��� E-mail" value="<?php echo $data['login'];?>"/></center></li>
<li><center><input type="password" id="auth_pass" placeholder="������" value="<?php echo $data['pass'];?>"/></center></li>

<ul id="list-auth>">

<li><input type="checkbox" name="rememberme" id="rememberme"/><label for="rememberme">��������� ����</label></li>

<li><a id="remindpass" href="#">������ ������?</a></li>


</ul>

<p align="left" id="button-auth"><a>����</a></p>
<p><button type="submit" id="reg_auth"><a href="registration.php">�����������</a></button></p>
</ul>


</form>

</div>
<div id="block-search1">

<form method="GET" action="search.php?q=" >
<input type="text" id="input-search" name="q" value="����� ����� � ���������" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><span id="span1"></span>
<input type="submit" id="button-search" value="�����" />




</form>


</div>
</div>
<?php
	include("include/block-header.php");
?>
<?php
	include("include/block-header-bottom.php");
?>

<div id="block-search">

<?php
    include("include/parametr.php");
?>

</div>

<div id="block-content">
<ul id="block-tur">
 
<?php



 $result1 = mysql_query("SELECT * FROM transport INNER JOIN (location INNER JOIN directory ON location.id_location = directory.id_location) ON transport.id_transport = directory.id_transport",$link);
 if (mysql_num_rows($result1) > 0)
{
    $row = mysql_fetch_array($result1);
    
    do{


        echo '
        <li>
        <div class="block_content_ecs" >
        <center><a href="view_content.php?id='.$row["id_direct"].'" ><img src="/list_image/'.$row["image"].'"/></a></center>
        </div>
        <p class="style-tittle-tur"><a href="view_content.php?id='.$row["id_direct"].'" >'.$row["title"].'</a></p>
        <center><p>���������: '.$row["price"].'</p></center>
        <ul class = "counts-list">
        <li><img src="/images/count.png"/><p>'.$row["count"].'</p></li>
        </ul>
        <div class="block-description">�����������������: '.$row["late"].' �.</div>
        <div class="block-loc">��������������:'.$row["name_location"].'</div>
        <div class="block-trans">���������:'.$row["name_transport"].'</div>
        </li>
        ';
       
    }
    while($row = mysql_fetch_array($result1));

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