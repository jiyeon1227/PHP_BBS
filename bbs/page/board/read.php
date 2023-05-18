<?php
    include $_SERVER['DOCUMENT_ROOT']."/bbs/db.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title> 게시판 </title>
<link rel ="stylesheet" type="text/css" href="/bbs/css/style.css?after"/>
</head>
<body>
    <?php
        $bno = $_GET['idx'];
        $sql = mq("select * from board where idx='".$bno."'");
        $board = $sql->fetch_array();
    ?>
<!-- 글 불러오기 -->
<div id ="board_read">
    <h2><?php echo $board['title']; ?> </h2>
        <div id = "user_info">
            <?php echo $board['name']; ?> <?php echo $board['date']; ?>
                <div id ="bo_content">
                    <?php echo ("$board[content]"); ?>
                </div>

<!-- 목록, 수정, 삭제 -->
<div id ="bo_ser">
    <ul>
        <li><a href="/bbs">[목록으로]</a></li>
        <li><a href="modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
		<li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
	</ul>
</div>
</div>
</body>
</html>