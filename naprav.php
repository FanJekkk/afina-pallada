<?php
 $list = mysqli_connect("localhost","admin","123456","bd_afina_pallada");
    mysqli_set_charset($list, "cp1251");
    
    function getDatastring(){
        global $list;
        $query = "SELECT directory.title, Sum(directory.count) AS count1 FROM directory GROUP BY directory.title;";
        $res = mysqli_query($list, $query);
        $data = '{"cols":[';
        $data .= '{"id":"","label":"Направление","type":"string"},';
        $data .= '{"id":"","label":"Просмотры","type":"number"},';
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