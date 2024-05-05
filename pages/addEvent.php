<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
    $database = new \repository\Database();

    ?>

        <style>
            #image-preview {
                display: flex;
                flex-wrap: wrap;
            }

            .preview-image {
                margin: 5px;
                max-width: 200px;
                max-height: 200px;
            }
        </style>


        <form action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/backend/UploadEvents.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title"/>
            <input type="date" name="date" />
            <input type="text" name="location"/>
            <textarea name="description" cols="30" rows="10"></textarea>
            <div id="image-preview"></div>
            <input type="file" name="images[]" id="file-input" multiple>
            <button name="submit">Přidat</button>
        </form>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editEvents">Zpět</a>

        <script>
            document.getElementById('file-input').addEventListener('change', function(event) {
                let preview = document.getElementById('image-preview');
                preview.innerHTML = '';
                let files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>


        <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");

