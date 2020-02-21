<?php

/*
echo $data = '{
  "cols": [
        {"id":"","label":"Туры","type":"string"},
        {"id":"","label":"Просмотры","type":"number"},
        {"id":"","label":"Заказы","type":"number"}
      ],
  "rows": [
        {"c":[{"v":"Владивосток"},{"v":400},{"v":100}]},
        {"c":[{"v":"Уссурийск"},{"v":300},{"v":200}]},
        {"c":[{"v":"Арсеньев"},{"v":200},{"v":300}]},
        {"c":[{"v":"Артем"},{"v":200},{"v":400}]},
        {"c":[{"v":"Находка"},{"v":100},{"v":500}]}
      ]
}';
    */
    $list = mysqli_connect("localhost","admin","123456","bd_afina_pallada");
    mysqli_set_charset($list, "cp1251");
    
    function getDatastring(){
        global $list;
        $query = "SELECT j2.title, Summ2/Summ1 AS count2 FROM (SELECT Sum(journal_app.cart_count) AS Summ1 FROM journal_app) as j1,(SELECT directory.title, Sum(journal_app.cart_count) AS Summ2 FROM directory INNER JOIN journal_app ON directory.id_direct = journal_app.cart_id_product GROUP BY directory.title) as j2 ORDER BY Summ2/Summ1 DESC";
        $res = mysqli_query($list,$query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"Направление","type":"string"},';
        $data .= '{"id":"","label":"Частота заказов","type":"number"},';
        $data .= '],"rows":[';
        
        while($row = mysqli_fetch_assoc($res))
        {
            $data .= '{"c":[{"v":"'.$row['title'].'"},{"v":'.$row['count2'].'}]},';
        }
        $data = rtrim($data,',');
        $data .=']}';
        return $data;
    }
    echo getDatastring();
    
    
    
?>