<?php
$db_host        ='localhost';
$db_user        ='admin';
$db_pass        ='123456';
$db_databese    ='bd_afina_pallada';

$link = mysql_connect($db_host,$db_user,$db_pass);

mysql_select_db('bd_afina_pallada',$link) or die("Нет соединения с БД".mysql_error());
mysql_query("SET names cp1251");

?>