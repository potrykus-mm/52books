<?php
// connect to the server & database
include_once ('dbconnect.php');


function is_post_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}


if(is_post_request())
{
    //handle form values sent by add.php
    $int_value = $_POST['isbn'] ?? '';
    $isbn = (int)$int_value;
    
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    

    $tiny_int = $_POST['devour'] ?? '';
    $devour = (int)$tiny_int;

     
    $sql = "INSERT INTO booklist ";
    $sql .= "(title, author, isbn, devour) ";
    $sql .= "VALUES ("; 

    $sql .= "'" . $isbn . "'," ;
    $sql .= "'" . $title . "',";
    $sql .= "'" . $author . "',";
    $sql .= "'" . $devour . "'";
    $sql .= ")";
    $results = mysqli_query($db, $sql);
    

//for INSERT statments, $results is true/fals
    if ($results)
    {
        $display_block = "<p>$title has been added! <p><a href=\"2booklist.php\">Show my booklists</a></p></p>"; 
    }

    else
    {
        //INSERT faild
        echo mysqli_error($db);
        $display_block = "error";
        exit;
    }

}

else 
{
    header("location: add.php");
}

?>