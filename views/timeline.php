<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/24/2018
 * Time: 9:31 PM
 */

?>

<div class="container mainContainer">

    <div class="row">
        <div class="col-md-8">

            <h2>Tweets for You</h2>
            <?php displayTweets('isFollowing') ?>

        </div>

        <div class="col-md-4">

            <?php displaySearch() ?>

            <hr>

            <?php displayTweetBox() ?>

        </div>
    </div>

</div>
