<?php

require_once ('dbconnect.php');

if(!isset($_GET['isbn']))
{
  header("location: 2booklist.php");
}
$isbn = $_GET['isbn'];

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

if(is_post_request()) {

  // Handle values 

  $subject = [];
  $subject['isbn'] = $isbn;
  $subject['title'] = $_POST['title'] ?? '';
  $subject['author'] = $_POST['author'] ?? '';
  $subject['devour'] = $_POST['devour'] ?? '';

  $result = update_subject($subject);
  if($result === true) 
  {
    header("location: 2booklist.php");
  } else {
    $errors = $result;
    
  }

} else {

  $subject = find_subject_by_isbn($isbn);
}

$subject_set = find_all_book();
$subject_count = mysqli_num_rows($subject_set);
mysqli_free_result($subject_set);

?>

<?php $page_title = 'Edit Book'; ?>
<?php require('shared/header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo ('2booklist.php'); ?>">&laquo; Back to List</a>

  <div class="edit book">
  <center><h1>Edit Book</h1>
    <br>
    <form action="<?php echo ('edit.php?isbn=' . ($isbn)); ?>" method="post">
      <table>
        <tr>
          <th>ISBN</th>
          <th>Title</th>
          <th>Author</th>
          <th>Devour</th>
        </tr> 
        <tr> 
          <td><label class= "hidden" for="isbn">isbn</label><input type="text" id="isbn" name="isbn" value="<?php echo ($subject['isbn']); ?>" /></td>
          <td><label class= "hidden" for="title">title</label><input type="text" id="title" name="title" value="<?php echo ($subject['title']); ?>" /></td>
          <td><label class= "hidden" for="author">author</label><input type="text" id="author"  name="author" value="<?php echo ($subject['author']); ?>" /></td>
          <td>
          <label class= "hidden" for="hidden">hidden</label><input type="hidden" id="hidden" name="devour" value="0" />
          <center><label class= "hidden" for="devour">cb</label><input type="checkbox" id="devour" name="devour" value="1"<?php if($subject['devour'] == "1") { echo " checked"; } ?> /></center>
          </td> 
        </tr>
      
          <td><label class= "hidden" for="sub">sub</label>      
            <input type="submit" id ="sub" value="Edit Book" /> 
          </td>  
      
      </table></center>
    </form>

  </div>

</div>

<br>
<?php require('shared/footer.php'); ?>
   </body>
</html>
