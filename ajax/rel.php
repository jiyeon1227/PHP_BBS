<?php 
    $index = $_GET['index'];

    $desc = ['좋아하는건','좋아하는 색은 ','좋아하는 가수는 '];
    $name = ['놀기','하늘색','비투비'];

    $json = json_encode(array('desc'=>$desc[$index],'name'=>$name[$index]));
    
    echo($json);
?>