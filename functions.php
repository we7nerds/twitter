<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:15 AM
 */

include "globals.php";

session_start();

$link = mysqli_connect($SERVER_SPACE, $DB_USER_NAME, $DB_PASSWORD, $DB_NAME);

if (mysqli_connect_errno()) {

    print_r(mysqli_connect_error());
    exit();

}

if ($_GET['function'] == "logout") {

    session_unset();

}

function displayTweets($type) {

    global $link;

    if ($type == 'public') {

        $whereClause = "";

    } else if ($type == "isFollowing" && isset($_SESSION['id'])) {

        $query = "SELECT * FROM isFollowing WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION['id']).";";
        $result = mysqli_query($link, $query);

        $whereClause = "";

        while ($row = mysqli_fetch_assoc($result)) {

            if ($whereClause == "") {

                $whereClause = "WHERE";

            } else {

                $whereClause.= " OR";

            }

            $whereClause.= " userid = ".$row['isFollowing'];

        }

    } else if ($type == 'yourtweets' && isset($_SESSION['id'])) {

        $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);

    } else if ($type == 'search') {

        echo "<p>Showing search results for '".mysqli_real_escape_string($link, $_GET['q'])."':</p>";

        $whereClause = "WHERE tweet LIKE '%".mysqli_real_escape_string($link, $_GET['q'])."%'";

    } else if (is_numeric($type)) {

        $userQuery = "SELECT * FROM users WHERE `id` = ".$type." LIMIT 1";
        $userResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userResult);

        echo "<h2>".mysqli_real_escape_string($link, $user['email'])."'s Tweets</h2>";

        $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $type);

    }

    $query = "SELECT * FROM tweets ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 0) {

        echo "There are no tweets to display";

    } else {

        while ($row = mysqli_fetch_assoc($result)) {

            $userQuery = "SELECT * FROM users WHERE `id` = ".$row['userid']." LIMIT 1";

            $userResult = mysqli_query($link, $userQuery);
            $user = mysqli_fetch_assoc($userResult);

            echo "<div class='tweet'><p><a href='?page=publicprofiles&userid=".$user['id']."' >".$user['email']."</a> <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago</span>:</p>";

            echo "<p>".$row['tweet']."</p>";

            echo "<p><a class='toggleFollow' data-userId = '".$row["userid"]."' href='#'>";

            $isFollowingQuery = "SELECT * FROM isFollowing WHERE `follower` = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND `isFollowing` = "
                .mysqli_real_escape_string($link, $row['userid'])." LIMIT 1;";
            $followingResult = mysqli_query($link, $isFollowingQuery);

            if (mysqli_num_rows($followingResult) > 0 ) {

                echo "Unfollow";

            } else {

                echo "Follow";

            }

            echo "</a></p></div>";

        }

    }

}

function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}

function displaySearch() {

    echo '<form class="form-inline">

        <div class="form-group">

            <input type="hidden" name="page" value="search">

            <input type="text" class="form-control" id="search" name="q" placeholder="Search">

        </div>

        <button class="btn btn-primary">Search Tweets</button>

    </form>';

}

function displayTweetBox() {

    if ($_SESSION['id'] > 0) {

        echo '<div id="tweetSuccess" class="alert alert-success">Your tweet was posted successfully.</div>
        <div id="tweetFail" class="alert alert-danger"></div>

    <div class="form">

        <div class="form-group">

            <textarea class="form-control" id="tweetContent" rows="3"></textarea>

        </div>

        <button class="btn btn-primary" id="postTweetBtn">Post Tweet</button>

    </div>';

    }

}

function displayUsers() {

    global $link;

    $query = "SELECT * FROM users LIMIT 10";

    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<p><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";

    }

}