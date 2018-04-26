<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/25/2018
 * Time: 8:30 PM
 */
?>
<div class="container mainContainer">

    <div class="row">
        <div class="col-md-8">

            <h2>Your Tweets</h2>
            <?php displayTweets('yourtweets') ?>

</div>

<div class="col-md-4">

    <?php displaySearch() ?>

    <hr>

    <?php displayTweetBox() ?>

</div>
</div>

</div>