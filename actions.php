<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 8:13 AM
 */

include "functions.php";

if ($_GET["action"] == "loginSignup") {

    $error = "";

    if (isset($_POST['email']) && $_POST['email'] != "") {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

            $error .= "Please enter a valid email address. ";

        }

    } else {

        $error .= "An email is required. ";

    }

    if (!$_POST['password']) {

        $error .= "A password is required. ";

    }

    if ($_POST['loginActive'] == "0" && $error == "") {

        // SignUp logic: check for the user
        $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) > 0 ) {

            $error .= "That email address is already taken. ";

        } else {

            $query = "INSERT INTO users (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email']). "',
                '". mysqli_real_escape_string($link, $_POST['password']) ."')";

            if (mysqli_query($link, $query)) {

                $userId = mysqli_insert_id($link);

                $query = "UPDATE users SET password = '" . md5(md5($userId).$_POST['password'])."' WHERE id =
                    " . $userId ." LIMIT 1";

                mysqli_query($link, $query);

                echo 1;

                $_SESSION['id'] = $userId;

            } else {

                $error = "Couldn't create user. Please try again. ";

            }

        }

    } else if ($error == "") {

        // Login logic: see if the user exists and confirm their password
        $query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($link, $_POST['email']) . "' LIMIT 1";
        $result = mysqli_query($link, $query);

        if ($row = mysqli_fetch_assoc($result)) {

            if ($row['password'] == md5(md5($row['id']).$_POST['password'])) {

                echo 1;

                $_SESSION['id'] = $row['id'];

            } else {

                $error .= "Could not find that username / password combination. Please try again. ";

            }

        } else {

            $error .= "Could not find that user. ";

        }

    }

    if ($error != "") {

        echo $error;

    }

}

if ($_GET['action'] == "toggleFollow") {

     $query = "SELECT * FROM isFollowing WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND `isFollowing` = "
        .mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1;";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0 ) {

        $row = mysqli_fetch_assoc($result);

        mysqli_query($link, "DELETE FROM isFollowing WHERE id = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1;");

        echo "1";

    } else {

        mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES (".mysqli_real_escape_string($link,
                $_SESSION['id']).", ".mysqli_real_escape_string($link, $_POST['userId']).");");

        echo "2";

    }

}

if ($_GET['action'] == "postTweet") {

    if (!$_POST['tweetContent']) {

        echo "Your tweet is empty.";

    } elseif (strlen($_POST['tweetContent']) > 140) {

        echo "Your tweet is too long!";

    } else {

        if (mysqli_query($link, "INSERT INTO tweets (`tweet`, `userid`, `datetime`) VALUES ('".mysqli_real_escape_string($link,
                $_POST['tweetContent'])."', '".mysqli_real_escape_string($link, $_SESSION['id'])."', NOW());")) {

            echo "1";

        } else {

            echo mysqli_error($link);

        }


    }

}