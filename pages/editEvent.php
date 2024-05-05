<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
    $database = new \repository\Database();

    $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
    if ($eventId === null) {
        header("location: /webUSI/admin?EventDoesNotExists");
        exit();
    }

    $event = $database->getEventById($eventId);
    $imagesExist = $database->getImagesByEventId($eventId);

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


        <form action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/backend/UploadEvents.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="eventId" value="<?php echo $event["event_id"]; ?>">
            <input type="text" name="title" value="<?php echo $event["title"]; ?>"/>
            <input type="date" name="date" value="<?php echo $event["date"]; ?>"/>
            <input type="text" name="location" value="<?php echo $event["location"]; ?>"/>
            <textarea name="description" cols="30" rows="10"><?php echo $event["description"]; ?></textarea>


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
