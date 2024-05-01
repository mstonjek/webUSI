<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Stránka nenalezena</title>
    <style>
body {
    font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
    max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
    color: #dc3545;
    margin-bottom: 20px;
        }

        p {
    margin-bottom: 20px;
        }

        a {
    color: #007bff;
    text-decoration: none;
        }

        a:hover {
    text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404 - Stránka nenalezena</h1>
        <p>Omlouváme se, ale stránka, kterou hledáte, nebyla nalezena.</p>
        <p>Zkuste se vrátit <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/index">domů</a> nebo zkontrolujte URL adresu.</p>
    </div>
</body>
</html>
