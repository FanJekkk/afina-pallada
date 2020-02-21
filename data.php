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
        $query = "SELECT directory.title,directory.count,Sum(journal_app.cart_count) as count1 FROM directory INNER JOIN journal_app ON directory.id_direct = journal_app.cart_id_product GROUP BY directory.title,directory.count";
        $res = mysqli_query($list, $query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"�������� ���������","type":"string"},';
        $data .= '{"id":"","label":"���������","type":"number"},';
        $data .= '{"id":"","label":"������","type":"number"}';
        $data .= '],"rows":[';
        
        while($row = mysqli_fetch_assoc($res))
        {
            $data .= '{"c":[{"v":"'.$row['title'].'"},{"v":'.$row['count'].'},{"v":'.$row['count1'].'}]},';
        }
        $data = rtrim($data,',');
        $data .=']}';
        return $data;
    }
    echo getDatastring();
    
    
    
?>