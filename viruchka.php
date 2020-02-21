<?php

/*
echo $data = '{
  "cols": [
        {"id":"","label":"����","type":"string"},
        {"id":"","label":"���������","type":"number"},
        {"id":"","label":"������","type":"number"}
      ],
  "rows": [
        {"c":[{"v":"�����������"},{"v":400},{"v":100}]},
        {"c":[{"v":"���������"},{"v":300},{"v":200}]},
        {"c":[{"v":"��������"},{"v":200},{"v":300}]},
        {"c":[{"v":"�����"},{"v":200},{"v":400}]},
        {"c":[{"v":"�������"},{"v":100},{"v":500}]}
      ]
}';
    */
    $list = mysqli_connect("localhost","admin","123456","bd_afina_pallada");
    mysqli_set_charset($list, "cp1251");
    
    function getDatastring(){
        global $list;
        $query = "SELECT directory.title, Sum(cart_count*cart_price) AS vir FROM directory INNER JOIN journal_app ON directory.id_direct = journal_app.cart_id_product GROUP BY directory.title ORDER BY vir desc";
        $res = mysqli_query($list,$query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"��������","type":"string"},';
        $data .= '{"id":"","label":"�������","type":"number"},';
        $data .= '],"rows":[';
        
        while($row = mysqli_fetch_assoc($res))
        {
            $data .= '{"c":[{"v":"'.$row['title'].'"},{"v":'.$row['vir'].'}]},';
        }
        $data = rtrim($data,',');
        $data .=']}';
        return $data;
    }
    echo getDatastring();
    
    
    
?>