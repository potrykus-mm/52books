<?php

  // booklist

  function find_all_book() {
    global $db;

    $sql = "SELECT * FROM booklist ";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    if (!$result) {
    	exit("Database query failed.");
    }
    
    return $result;
  }


  function find_subject_by_isbn($isbn) {
    global $db;

    $sql = "SELECT * FROM booklist ";
    $sql .= "WHERE isbn='" . $isbn . "'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
    	exit("Database query failed.");
    }
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
  }

  function find_review_by_isbn($isbn) {
    global $db;

    $revsql = "SELECT * FROM review ";
    $revsql .= "WHERE isbn='" . $isbn . "'";
    $revresult = mysqli_query($db, $revsql);
    if (!$revresult) {
    	exit("Database query failed.");
    }
    $revsubject = mysqli_fetch_assoc($revresult);
    mysqli_free_result($revresult);
    return $revsubject;
  }

  
  function insert_subject($subject) {
    global $db;

    $sql = "INSERT INTO booklist ";
    $sql .= "(isbn, title, author, devour) ";
    $sql .= "VALUES (";
    $sql .= "'" . $subject['isbn'] . "',";
    $sql .= "'" . $subject['title'] . "',";
    $sql .= "'" . $subject['author'] . "',";
    $sql .= "'" . $subject['devour'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      if(isset($connection)) {
        mysqli_close($connection);
      }
      exit;
    }
  }
  function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
  }


  function update_subject($subject) {
    global $db;

    $sql = "UPDATE booklist SET ";
    $sql .= "isbn='" . $subject['isbn'] . "', ";
    $sql .= "title='" . $subject['title'] . "', ";
    $sql .= "author='" . $subject['author'] . "', ";
    $sql .= "devour='" . $subject['devour'] . "' ";
    $sql .= "WHERE isbn='" . $subject['isbn'] . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      if(isset($connection)) {
        mysqli_close($connection);
      }
      exit;
    }

  }

  function delete_subject($isbn) {
    global $db;

    $sql = "DELETE FROM booklist WHERE isbn ='" . $isbn . "' ";
    $sql2 = "DELETE FROM review WHERE isbn ='" . $isbn . "' ";

    $result = mysqli_query($db, $sql);
    $result2 = mysqli_query($db, $sql2);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      if(isset($connection)) {
        mysqli_close($connection);
      }
      exit;
    }
    if($result2) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      if(isset($connection)) {
        mysqli_close($connection);
      }
      exit;
    }
  }


?>
