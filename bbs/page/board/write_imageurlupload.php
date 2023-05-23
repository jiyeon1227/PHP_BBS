<!doctype html>
<head>
<meta charset = "UTF-8">
<title>게시판</title>
<link rel ="stylesheet" type="text/css" href="/bbs/css/style.css?after"/>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- <script src='https://cdn.tiny.cloud/1/no-api-key/tinymce/4/tinymce.min.js'></script> -->
<!-- 이미지 업로드 할 때 base64말고 url로 업로드하는 방법사용하려고 고민고민한 파일,,,, -->


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
                        plugins: 'image code',
                        toolbar: 'undo redo | link image',
                        /* enable title field in the Image dialog*/
                        image_title: true,
                        /* enable automatic uploads of images represented by blob or data URIs*/
                        automatic_uploads: true,
                        images_upload_url: 'postAcceptor.php',
                        /*
                            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                            images_upload_url: 'postAcceptor.php',
                            here we add custom filepicker only to Image dialog
                        */
                        file_picker_types: 'image',
                        /* and here's our custom image picker*/
                        file_picker_callback: function (cb, value, meta) {
                            var input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');

                            /*
                            Note: In modern browsers input[type="file"] is functional without
                            even adding it to the DOM, but that might not be the case in some older
                            or quirky browsers like IE, so you might want to add it to the DOM
                            just in case, and visually hide it. And do not forget do remove it
                            once you do not need it anymore.
                            */

                            input.onchange = function () {
                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.onload = function () {
                                /*
                                Note: Now we need to register the blob in TinyMCEs image blob
                                registry. In the next release this part hopefully won't be
                                necessary, as we are looking to handle it internally.
                                */
                                var id = 'blobid' + (new Date()).getTime();
                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(',')[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);

                                /* call the callback and populate the Title field with the file name */
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                            reader.readAsDataURL(file);
                            };

                            input.click();
                        },
                        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                        });










                    // tinymce.init({
                    //     selector: '#ucontent',
                    //     images_upload_url: 'postAcceptor.php',
                    //     images_upload_base_path: '/file',
                    //     plugins: 'image code',
                    //     toolbar: 'undo redo | image code',
                    //     images_upload_handler: function (blobInfo, success, failure) {
                    //         var xhr, formData;
                    //         xhr = new XMLHttpRequest();
                    //         xhr.withCredentials = false;
                    //         xhr.open('POST', 'postAcceptor.php');
                    //         xhr.onload = function() {
                    //             var json;
                    //             if (xhr.status != 200) {
                    //                 failure('HTTP Error: ' + xhr.status);
                    //                 return;
                    //             }
                    //             json = JSON.parse(xhr.responseText);
                    //             if (!json || typeof json.location != 'string') {
                    //                 failure('Invalid JSON: ' + xhr.responseText);
                    //                 return;
                    //             }
                    //             success(json.location);
                    //         };
                    //         formData = new FormData();
                    //         formData.append('file', blobInfo.blob(), blobInfo.filename());
                    //         xhr.send(formData);
                    //     },
                    // content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                    // });
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