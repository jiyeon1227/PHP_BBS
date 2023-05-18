<!-- 게시글 수정 -->
<?php
	include $_SERVER['DOCUMENT_ROOT']."/bbs/db.php";
   
	$bno = $_GET['idx'];
	$sql = mq("select * from board where idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title> 게시판 </title>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="/bbs/css/style.css?after" />
</head>
<body>
    <div id = "write_area">
        <form action ="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
            <div id ="in_title">
                <textarea name = "title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
            </div>
            <div class = "wi_line"></div>
            <div id = "in_name">
                <textarea name="name" id="uname" rows="1" cols="55" placeholder="글쓴이" maxlength="100" required><?php echo $board['name']; ?></textarea>
            </div>
            <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['content']; ?></textarea>
                        <script>
                        tinymce.init({
                            selector: '#ucontent'
                        });
                        </script>
                    </div>
                    <div class="bt_se">
                        <button type="submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>