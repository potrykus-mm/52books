<?php 
include_once ('dbconnect.php');

 $isbn = $_GET['isbn'] ; //PHP >7


 $result = find_subject_by_isbn($isbn);
 
 //header("Location: 2booklist.php");
 $revresult = find_review_by_isbn($isbn);
 
?>

<?php $page_title = 'Review' ?>
<?php require('shared/header.php'); ?>



<div id="content">

  <a class="back-link" href="<?php echo ('2booklist.php'); ?>" >&laquo; Back to List</a>

  <div class="book show">
     <br> 
    <h1> Title: "<?php echo $result['title'];?>" </h1>
    
    <h2><i><pre id="tab">&#9by:<?php echo $result['author'];?></h2></pre></i><br><br>
    
    <p><?php 
      //if ($revresult['review'] != ""){
      if (isset($revresult['review'])){
        echo $revresult['review'];
      }else {
        echo "No review yet";
      }   
    ?></p>
    <br>


  </div>

</div>

<?php require('shared/footer.php'); ?>  