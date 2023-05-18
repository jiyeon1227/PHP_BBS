<!-- 이 페이지는 검색 결과를 search_result.php로 보내는 페이지-> 검색 결과를 한 페이지에서 처리하는게 index.php임 -->
<?php include $_SERVER['DOCUMENT_ROOT']."/bbs/db.php"; ?>
<!doctype html>
<head>
<meta charset = "UTF-8">

<title>게시판</title>
<link rel ="stylesheet" type="text/css" href="/bbs/css/style.css?after"/>
<script src="//code.jquery.com/jquery.min.js"></script>
</head>

<body>
<div id = "board_area">
    <h1><a href="/bbs">게시판</a></h1>

    <div id = "search_box">
        <form action = "/bbs/page/board/search_result.php" method = "get">
            <select name = "catgo">
                <option value = "title"> 제목 </option>
                <option value = "name"> 글쓴이 </option>
                <option value = "content"> 내용 </option>
            </select>
            <input type="text" name="search" size="40" require="required"/><button>검색</button>
        </form>
    </div>

        <table class = "list-table">
        <thead>
            <tr>
                <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="70">글쓴이</th>
                <th width="70">작성일</th>
            </tr>
        </thead>

        <?php
        //페이징
            if(isset($_GET['page'])){ //page 값이 있으면 $page변수에 GET으로 받온 page를, 아니면 page변수에 1을 넣는다.
            $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $sql = mq("select * from board");
            $row_num = mysqli_num_rows($sql);//게시판 총 레코드
            $list = 5;//한 페이지에 보여줄 개수
            $block_ct = 5;//블록당 보여줄 페이지 개수

            $block_num = ceil($page/$block_ct);//현재페이지 블록 구하기 (ceil은 반올림하는 함수)
            $block_start = (($block_num - 1) * $block_ct) + 1;//블록의 시작번호
            $block_end = $block_start + $block_ct -1;//블록 마지막 번호

            $total_page = ceil($row_num / $list);//페이징한 페이지 수 구하기
            if($block_end > $total_page) $block_end = $total_page;//만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
            $total_block = ceil($total_page / $block_ct);//블럭 총 개수
            $start_num = ($page -1) * $list;//시작번호 (page-1)에서 $list 를 곱한다.

        // board테이블에서 idx를 기준으로 내림차순 5개 표시
        $sql3 = mq("select * from board order by idx desc limit $start_num, $list");
            while($board = $sql3 -> fetch_array()) //쿼리 결과를 배열로 행이 끝날때까지 반복실행
            {
                $title = $board["title"];
                if(strlen($title)>30)
                {
                    $title = str_replace($board["title"], mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]); //title이 30을 넘어서면 ...으로 표시
                }
        ?>

        <tbody>
            <tr>
                <td width="70"><?php echo $board['idx']; ?></td>
                <td width="500"><a href="page/board/read.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
                <td width="120"><?php echo $board['name'] ?></td>
                <td width="100"><?php echo $board['date'] ?></td>
            </tr>
        </tbody>
        <?php } ?>
        </table>
        
        <!-- 페이징 넘버-->
        <div id ="page_num">
            <ul>
                <?php
                if($page <= 1)
                {//만약 page가 1보다 크거나 같다면
                    echo"<li class='fo_re'>처음</li>";
                }else{
                    echo"<li><a href='?page=1'>처음</a></li>";
                }
                if($page <= 1)
                {
                    //만약 page가 1보다 크거나 같다면 빈값
                } else {
                $pre = $page -1;
                    echo "<li><a href='?page=$pre'>이전</a></li>";
                }
                for ($i = $block_start; $i <= $block_end; $i++){
                    if($page == $i){
                        echo "<li class='fo_re'>[$i]</li>";
                    }else{
                        echo "<li><a href='?page=$i'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block){
                }else{
                    $next =$page + 1;
                    echo "<li><a href='?page=$next'>다음</a></li>";
                }
                if($page >= $total_page){
                    echo "<li class='fo_re'>마지막</li>";
                }else{
                    echo "<li><a href='?page=$total_page'>마지막</a></li>";
                }
                ?>
        <div id ="write_btn">
            <a href="/bbs/page/board/write.php"><button>글쓰기</button></a>
        </div>
        
        </div>
</body>
</html>
