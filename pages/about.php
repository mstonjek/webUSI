<?php

    namespace pages;

    session_start();

    use \repository\Database;
    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

    $database = new \repository\Database();

    $schools = $database->getSchools();
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

<section>
<?php foreach ($schools as $school): ?>
        
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/school?schoolId=<?php echo $school["school_id"]; ?>"><?php echo $school["title"]; ?></a>
        <?php endforeach; ?>
</section>

<?php


    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");




