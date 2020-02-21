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
        $query = "SELECT Sum(directory.count) AS count1, directory.late FROM directory GROUP BY directory.late ";
        $res = mysqli_query($list, $query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"Длительность маршрутов","type":"string"},';
        $data .= '{"id":"","label":"Частота запросов","type":"number"},';
        $data .= '],"rows":[';
        
        while($row = mysqli_fetch_assoc($res))
        {
            $data .= '{"c":[{"v":"'.$row['late'].' ч."},{"v":'.$row['count1'].'}]},';
        }
        $data = rtrim($data,',');
        $data .=']}';
        return $data;
    }
    echo getDatastring();
    
    
    
?>