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
        $query = "SELECT directory.title, Sum/Sum1 AS count1 FROM (SELECT Sum(directory.Count) AS Sum1 FROM directory) as t1,(SELECT directory.title, Sum(directory.Count) AS Sum FROM directory GROUP BY directory.title) as t2 INNER JOIN directory ON t2.title = directory.title GROUP BY directory.title,Sum/Sum1 ORDER BY Sum/Sum1 desc";
        $res = mysqli_query($list, $query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"Маршруты","type":"string"},';
        $data .= '{"id":"","label":"Частота просмотров","type":"number"},';
        $data .= '],"rows":[';
        
        while($row = mysqli_fetch_assoc($res))
        {
            $data .= '{"c":[{"v":"'.$row['title'].'"},{"v":'.$row['count1'].'}]},';
        }
        $data = rtrim($data,',');
        $data .=']}';
        return $data;
    }
    echo getDatastring();
    
    
    
?>