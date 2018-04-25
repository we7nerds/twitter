<?php
/**
 * Created by PhpStorm.
 * User: we7ne
 * Date: 4/21/2018
 * Time: 7:15 AM
 */

include "functions.php";

include "views/header.php";

if ($_GET['page'] == 'timeline') {
    include "views/timeline.php";
} else {
    include "views/home.php";
}

include "views/footer.php"

?>


