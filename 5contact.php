<?php
// connect to the server & database
include_once ('dbconnect.php');
?>

<html>
<?php $page_title = 'Contact' ?>
<?php require('shared/header.php'); ?>
<body>
<br><br><br><br>

<center><h1>Contact Us</h1>
  <br>
  <form class="contact" action="5contact.php" method="POST">
    
    <p>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" placeholder="Your name" required>
    </p>
    
    <p>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" placeholder="Your email" required>
    </p>
     
    <p>
      <label for="text">Comment</label>
      <textarea name="text" placeholder="Leave your comment here" required></textarea>
    </p>
    
    <p>
      <input type="submit" name="submit" value="Send" >
    </p>
  </form></center>
  <br>
</body>
</html>

  <?php 
    //check whether submit button is pressed or not
  if((isset($_POST['submit'])))
  {
    //fetching and store form data
    $Name = $db->real_escape_string($_POST['name']);
    $Email = $db->real_escape_string($_POST['email']);
    $comment = $db->real_escape_string($_POST['text']);
    //insert data frm the variables into the database
    $sql="INSERT INTO contacts (name, email, comment) VALUES ('".$Name."','".$Email."', '".$comment."')";
    //Execute the query and returning a message
    if(!$result = $db->query($sql)){
      die('Error [' . $db->error . ']');
    }
  else
   echo '<script>alert("Thank you!")</script>';
  }
  ?>
     
  <?php require('shared/footer.php'); ?>
  </body>
</html>