<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:20 AM
 */
?>
<div class="container mainContainer">

    <div class="row">
        <div class="col-md-8">

            <h2>Recent Tweets</h2>
            <?php displayTweets('public') ?>

        </div>

        <div class="col-md-4">

            <?php displaySearch() ?>

            <hr>

            <?php displayTweetBox() ?>

        </div>
    </div>

</div>