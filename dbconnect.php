<?php

// connect ot server and select databse
$db = mysqli_connect("localhost", "root", "root") or die (mysqli_error($db));

mysqli_select_db($db, "52books")  or die(mysqli_error($db));

require_once('query_functions.php');
?> 