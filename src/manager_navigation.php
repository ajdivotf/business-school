<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="man_nav_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
</head>
<title>Личный кабинет менеджера</title>
</head>

<body>
    <div id="man-nav">
        <nav class="navbar navbar-expand-lg brown_panel">
            <a class="navbar-brand" href="#">Личный кабинет менеджера</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-4">
                    <li class="nav-item">
                        <a class="nav-link" href="user_orders.php">Заявки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manager_profile.php">Программы обучения</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reports.php">Отчёты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Выход</a>
                    </li>
                    <script>
                        $(document).ready(
                            function() {
                                let str = document.location.href;
                                str = str.substring(str.lastIndexOf('/') + 1);
                                $(`[href='${str}']`).addClass("active");
                            }
                        );
                    </script>
                </ul>
            </div>
        </nav>
    </div>
</body>

</html>
<style>
    .nav-link {
        color: black !important;
    }
</style>