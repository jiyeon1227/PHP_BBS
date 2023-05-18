<?php
    include $_SERVER['DOCUMENT_ROOT']."/bbs/db.php";
?>
<!doctype html>
<head>
<meta charset = "UTF-8">
<title> 게시판 </title>
<link rel ="stylesheet" type="text/css" href="/bbs/css/style.css?after"/>
</head>
<body>
<div id = "board_area">
    <?php
    $catagory = $_GET['catgo'];
    $search_con = $_GET['search'];

    //mysqli_real_escape_string 방식으로 쓸 때는 이렇게 씀 근데 이 방식은 DB에 부하를 많이 줌
    // $catagory = mysqli_real_escape_string($db,$_GET['catgo']);
    // $search_con = mysqli_real_escape_string($db,$_GET['search']);
    ?>

    <h3><?php echo $catagory; ?>에서 '<?php echo $search_con; ?>' 검색결과 </h3>
    <h4 style="margin-top:30px;"><a href="/bbs">홈으로</a></h4>
        <table class = "list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                </tr>
            </thead>
            <?php
                //mysqli_real_escape_string방식 대신 addslashes방식으로 사용
                $catagory = addslashes($catagory);
                $search_con = addslashes($search_con);
                $sql2 = mq("select * from board where ".$catagory." like '%{$search_con}%' order by idx desc");
                //쿼리문 작성은 이렇게 하는것보다 line.34 쿼리문으로 작성할것 ~!
                // $sql2 = mq("select * from board where $catagory like '%$search_con%' order by idx desc");

                // var_dump($sql2);//sql2값이 있는지 확인

                while($board = $sql2 -> fetch_array()){
                    //title변수에 DB에서 가져온 TITLE을 선택
                    $title = $board["title"];
                        if(strlen($title)>30){
                            //title이 30을 넘어서면 ... 표시
                            $title =  str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                        }

            ?>
            <tbody>
            <tr>
                <td width="70"><?php echo $board['idx']; ?></td>
                <td width="500"><a href="read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
                <td width="120"><?php echo $board['name'] ?></td>
                <td width="100"><?php echo $board['date'] ?></td>
            </tr>
            </tbody>
            <?php  }?>
        </table>
</body>