<?php
 
    header('Content-Type: text/html; charset=utf-8'); // utf-8 인코딩

    //DB주소, DB계정 아이디,  DB계정비밀번호, DB이름 

    $db = new mysqli("localhost","root","","bbs");//DB연결
    $db -> set_charset("utf8");

    function mq($sql)
    {
        global $db; //global은 외부에서 선언된 $sql을 함수내에서 쓸 수 있도록 해줌
        return $db -> query($sql);
    }
?>