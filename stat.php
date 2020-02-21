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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
       var jsonData = $.ajax({
          url: "data.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addColumn('number', 'Заказы');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);
*/
        var options = {
          chart: {
            title: 'Количество просмотров и заказов',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var jsonData = $.ajax({
          url: "naprav.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Task');
data.addColumn('number', 'Hours per Day');
data.addRows([
  ['Work', 2],
  ['Eat', 2],
  ['Commute', 2],
  ['Watch TV', 2],
  ['Sleep', {v:7, f:'7.000'}]
]);*/

        var options = {
          title: 'Частота запросов по направлениям'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "stoim.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          title: 'Частота запросов по направлениям'
        };

        var chart = new google.visualization.PieChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
        <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "stoim.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          chart: {
            title: 'Частота просмотров по маршрутам',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

          var chart = new google.charts.Bar(document.getElementById('curve_chart1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "stoim2.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          chart: {
            title: 'Частота заказов по маршрутам',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('curve_chart2'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
         <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "viruchka.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          chart: {
            title: 'Выручка по маршрутам',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

          var chart = new google.charts.Bar(document.getElementById('viruchka'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "late.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          chart: {
            title: 'Количество просмотров в зависимости от длительности туров',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('curve_chart_late'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
     <script>
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
     function drawChart() {
       var jsonData = $.ajax({
          url: "price.php",
          dataType: "json",
          async: false
          }).responseText; 
        var data = new google.visualization.DataTable(jsonData);
/*data.addColumn('string', 'Туры');
data.addColumn('number', 'Просмотры');
data.addRows([
  ['John Lennon', 1000],
  ['Paul McCartney', 1200],
  ['George Harrison', 1300],
  ['Ringo Starr', 1250]
]);*/

     var options = {
          chart: {
            title: 'Частота заказов в зависимости от стоимости туристких маршрутов',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('curve_chart_price'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
        
 
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
     
}
     
?>
<div id="block-top-auth">
<div class="corner"></div>
<form action="auth.php" method="POST">

<ul id="input-email-pass">

<h3 class="h3-title">Вход</h3>
<p id="message-auth">Неверный логин или пароль</p>

<li><center><input type="text" id="auth_login" placeholder="Логин или E-mail" value="<?php echo $data['login'];?>"/></center></li>
<li><center><input type="password" id="auth_pass" placeholder="Пароль" value="<?php echo $data['pass'];?>"/></center></li>

<ul id="list-auth>">

<li><input type="checkbox" name="rememberme" id="rememberme"/><label for="rememberme">Запомнить меня</label></li>

<li><a id="remindpass" href="#">Забыли пароль?</a></li>


</ul>

<p align="left" id="button-auth"><a>Вход</a></p>
<p><button type="submit" id="reg_auth"><a href="registration.php">Регистрация</a></button></p>
</ul>


</form>

</div>
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
<div id="curve_chart" style="width: 100%; height: 500px"></div>
<div id="curve_chart1" style="width: 100%; height: 500px"></div>
<div id="curve_chart2" style="width: 100%; height: 500px"></div>
<div id="viruchka" style="width: 100%; height: 500px"></div>
<div id="curve_chart_price" style="width: 100%; height: 500px"></div>
<div id="curve_chart_late" style="width: 100%; height: 500px"></div>
<center><a href="stat1.php">Количество просмотров и заказов по маршрутам</a></center>
<center><a href="stat2.php">Количество запросов по направлениям</a></center>
</ul>

</div>

<?php
	include("include/block-footer.php");
?>

</div>

</body>
</html>