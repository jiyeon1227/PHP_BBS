<!doctype html>
<head>
<meta charset = "UTF-8">
<title>게시판</title>
<link rel ="stylesheet" type="text/css" href="/bbs/css/style.css?after"/>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>
    <div id ="board_write">
        <h1><a href="/bbs">자유게시판</a></h1>
        <h4>글을 작성하는 공간입니다.</h4>
            <div id ="write_area">
                <form action = "write_ok.php" method ="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" require></textarea>
                    </div>
                    <div class = "wi_line"></div>
                    <div id = "in_name">
                        <textarea name="name" id="uname" rowa="1" cols="55" placeholder="글쓴이" maxlength="100" require></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id = "in_content">
                        <textarea name = "content" id ="ucontent" placeholder = "내용" require></textarea>


                        
                    <script>
                        tinymce.init({
                            selector: '#ucontent',
                            // images_upload_url: 'postAcceptor.php',
                            plugins: 'image code',
                            toolbar: 'undo redo | link image' ,
                            image_title: true,
                            automatic_uploads: true, 
                            file_picker_types: 'image',
                            /* and here's our custom image picker*/
                            file_picker_callback: (cb, value, meta) => {
                                const input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');

                                input.addEventListener('change', (e) => {
                                const file = e.target.files[0];

                                const reader = new FileReader();
                                reader.addEventListener('load', () => {
                                    /*
                                    Note: Now we need to register the blob in TinyMCEs image blob
                                    registry. In the next release this part hopefully won't be
                                    necessary, as we are looking to handle it internally.
                                    */
                                    const id = 'blobid' + (new Date()).getTime();
                                    const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                    const base64 = reader.result.split(',')[1];
                                    const blobInfo = blobCache.create(id, file, base64);
                                    blobCache.add(blobInfo);

                                    /* call the callback and populate the Title field with the file name */
                                    cb(blobInfo.blobUri(), { title: file.name });
                                });
                                reader.readAsDataURL(file);
                                });

                                input.click();
                            },
                            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
                            
                        });
                    </script>



                    </div>
                    
                    <div class = "bt_se">
                        <button type = "submit">글 작성</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>