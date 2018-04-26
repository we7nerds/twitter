<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:20 AM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Twitter Clone</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Twitter</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="?page=timeline">Your Timeline</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=yourtweets">Your tweets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=publicprofiles">Public Profile</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">

            <?php if ($_SESSION['id']) { ?>

                <a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>

            <?php } else { ?>

                <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">Login/Signup</button>

            <?php } ?>
        </div>
    </div>
</nav>
