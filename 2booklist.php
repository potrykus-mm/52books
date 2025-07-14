   
<?php
// connect to the server & database
include_once ('dbconnect.php');

  session_start();

	if (!isset ($_SESSION["u_id"]))
	{
		header ("location: login.php");
	}
  
  $sql = "SELECT * FROM booklist ";
  
  $result = mysqli_query($db, $sql) or die(mysqli_error($db));

  if (mysqli_num_rows($result) <= 0)
	{
		// add "you've not added any book yet" message to the display_block
		$display_block = "<tr><td colspan='2'>You don't have any book on the list yet. Press \"Add new book\" to get started!</td></tr>";
		$delflag = 0;
	}
  else
  {
    $display_block = "Book list: ";
    
  }
?>
  
  
  <?php $page_title = 'Book List' ?>
  <?php require('shared/header.php'); ?>
  
  <h1>
  <?php echo $display_block; ?>
  </h1>
  <br>
  <center><table class="list" >
    <tr>
      <th>ISBN</th>
      <th>Title</th>
      <th>Author</th>
      
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      
   </tr>
   <?php while($booklist = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $booklist['isbn'];?></td>
        <td><?php echo $booklist['title']; ?></td>
        <td><?php echo $booklist['author']; ?></td>
        <td><?php echo $booklist['devour'] == 1 ? 'read' : 'to read'; ?></td>
        <td><a class="red" href="<?php echo ('review_show.php?isbn='.$booklist['isbn']); ?> ">Review</a></td>
        <td><a class="red" href="<?php echo ('edit.php?isbn='.$booklist['isbn']); ?>">Edit</a></td>
        <td><a class="red" href="<?php echo ('delete.php?isbn='.$booklist['isbn']); ?>">Delete</a></td>
      </tr>
      <?php } ?>
  </table></center>

  <br>
  <div class="actions">
    <a class = "add" href="<?php echo 'add.php'?>">Add new Book</a>
  </div>
  
  <div class = "logout">
    <a class = "logout"  href="logout.php">Log me out</a>
  </div> 
  <br> 
    
  <?php require('shared/footer.php'); ?>   
    