<?php
    include $_SERVER['DOCUMENT_ROOT']."/bbs/db.php";


    $username = mysqli_real_escape_string($db,$_POST['name']); //post는 주소창에 값 노출안됨
    $title = mysqli_real_escape_string($db,$_POST['title']);
    $content = mysqli_real_escape_string($db, $_POST['content']);
    $date = date('Y-m-d');
    
    if($username && $title && $content){
        //쿼리문이 들어가기 전에 addslashes함수를 써야하는것,,,
        $sql = mq("insert into board(name, title, content, date) values('".$username."','".$title."','".$content."','".$date."')");
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/bbs';</script>";
    }else{
        echo"<script>
        alert('글쓰기에 실패하였습니다.');
        history.back();</script>";//실패했다면 location.href='/' 주석처리하고 어디서 값이 안들어왔는지 확인
    }
    ?>