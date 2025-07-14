<?php

require_once('dbconnect.php');

if(!isset($_GET['isbn'])) {
  header("Location: 2booklist.php");
}
$isbn = $_GET['isbn'];

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

if(is_post_request()) {

  $result = delete_subject($isbn);
  header("Location: 2booklist.php");

} else {
  $subject = find_subject_by_isbn($isbn);
}

?>

<?php $page_title = 'Edit book' ?>
<?php require('shared/header.php'); ?>

<div>

<a class="back-link" href="<?php echo ('2booklist.php'); ?>">&laquo; Back to List</a>

  <div class="delete">
    <br>
    <h1>Delete Book</h1>
    <br>
    <p>Are you sure you want to delete this book?</p>
    <br>
    <h2 class="item"><?php echo ($subject['title']); ?></h2>
    <br>
    <form action="<?php echo ('delete.php?isbn=' . ($subject['isbn'])); ?>" method="post">
      <div id="operations">
        <p><input type="submit" name="commit" value="Delete Subject" /></p>
        <br>
      </div>
    </form>
  </div>

</div>

<?php require('shared/footer.php'); ?>  
