<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:15 AM
 */

include "functions.php";

include "views/header.php";

if ($_GET['page'] == 'timeline' && isset($_SESSION['id'])) {

    include "views/timeline.php";

} else if ($_GET['page'] == 'yourtweets' && isset($_SESSION['id'])) {

    include "views/yourtweets.php";

} else if ($_GET['page'] == 'search') {

    include "views/search.php";

} else if ($_GET['page'] == 'publicprofiles') {

    include "views/publicprofiles.php";

} else {

    include "views/home.php";

}

include "views/footer.php";




