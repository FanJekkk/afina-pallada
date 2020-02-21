<script type="text/javascript">
$(document).ready(function() {
        $('#blocktrackbar').trackbar({
    onMove : function() {
    document.getElementById("start-price").value = this.leftValue;
    document.getElementById("end-price").value = this.rightValue;   
    },
    width : 160,
    leftLimit : 1000,
    leftValue : 1000,
    rightLimit : 40000,
    rightValue : 40000,
    roundUp : 1000
});
});
</script>
<div id="block-parametr">
<center><p class="title-price">Цена</p></center>
<form method="GET" action="search_filter.php">

<div id="block-input-price">
<ul>
<li><p>от</p></li>
<li><input type="text" id="start-price" name="start_price" value="1000" /></li>
<li><p>до</p></li>
<li><input type="text" id="end-price" name="end_price" value="30000" /></li>
<li><p>руб.</p></li>
</ul>




</div>
<div id="blocktrackbar"></div>

</div>
<div id="top-cat">Категория</div>
<?php 
$result = mysql_query("SELECT * FROM categories",$link);

if (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
do
{
    echo '
    
<div id="filter-cat">
<div id="title-filter"></div>
<input type="checkbox" name="cat[]" value="'.$row["id_cat"].'" id="checkcat'.$row["id_cat"].'" />  <label for="checkcat'.$row["id_cat"].'">'.$row["name_category"].'</label>
</div>';
}
while($row = mysql_fetch_array($result));
}
?>
<input type="submit" id="but-search" value ="Найти"/>
</form>