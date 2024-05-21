<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
    $database = new \repository\Database();

    $schoolId = isset($_GET['schoolId']) ? $_GET['schoolId'] : null;
    if ($schoolId === null) {
        header("location: /webUSI/admin?SchoolDoesNotExist");
        exit();
    }

    $school = $database->getSchoolById($schoolId);
    $imagesExist = $database->getImagesBySchoolId($schoolId);

    ?>

        <style>
            .existing-images-container {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 20px;
            }

            .existing-image-wrapper {
                position: relative;
                margin-right: 10px;
                margin-bottom: 10px;
            }

            .existing-image-wrapper img {
                width: 150px;
                height: 150px;
                object-fit: cover;
            }

            .existing-image-checkbox {
                position: absolute;
                top: 5px;
                right: 5px;
                z-index: 1;
            }

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


        <form action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/backend/UploadSchools.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="schoolId" value="<?php echo $school["school_id"]; ?>">
            <input type="text" name="title" value="<?php echo $school["title"]; ?>"/>
            <input type="text" name="address" value="<?php echo $school["address"]; ?>"/>
            <input type="text" name="headmaster" value="<?php echo $school["headmaster"]; ?>"/>
            <input type="text" name="web" value="<?php echo $school["webUrl"]; ?>"/>
            <textarea name="description" cols="30" rows="10"><?php echo $school["description"]; ?></textarea>
            <div class="existing-logo-container logo-preview">
                <img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo $school["logoUrl"]; ?>" alt="Existing Logo">
            </div>
            <input type="file" id="logo-input" name="logo">

            <div class="existing-images-container">
                <?php foreach ($imagesExist as $image): ?>
                    <div class="existing-image-wrapper">
                        <input type="checkbox" name="oldImages[]" value="<?php echo $image["image_id"]; ?>" class="existing-image-checkbox" checked>
                        <img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo $image["url"]; ?>" alt="Existing Image">
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="image-preview"></div>
            <input type="file" name="images[]" id="file-input" multiple>

            <button name="submit">Upravit</button>
        </form>

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editschools">Zpět</a>

        <script>
            document.getElementById('logo-input').addEventListener('change', function(event) {
                let preview = document.getElementById('logo-preview');
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
            document.getElementById('file-input').addschoolListener('change', function(school) {
                let preview = document.getElementById('image-preview');
                preview.innerHTML = '';
                let files = school.target.files;
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
