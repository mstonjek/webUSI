<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
    $database = new \repository\Database();
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");


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
            <label for="title">Název akce</label>
            <input type="text" id="title" name="title"/>
            <label for="date">Datum konání</label>
            <input type="date" id="date" name="date" />
            <label for="location"></label>
            <input type="text" id="location" name="location"/>
            <label for="desc">Popis</label>
            <textarea name="description" id="desc" cols="30" rows="10"></textarea>
            <label for="file-input">Obrázky</label>
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

