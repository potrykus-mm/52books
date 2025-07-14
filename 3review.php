<?php
// connect to the server & database
    include_once ('dbconnect.php');

	/* if (!isset ($_SESSION["u_id"]))
	{
		header ("location: login.php");
	} */

    $sql = "SELECT a.isbn, a.title, a.author, b.review, b.rating FROM booklist a JOIN review b ON a.isbn = b.isbn;";
    $results = mysqli_query($db, $sql) or die(mysqli_error($db));
    
    if (mysqli_num_rows($results) <= 0)
        {
            // add "you've not added any book yet" message to the display_block
            $display_block = "<tr><td colspan='2'>You don't have any reviews on the list yet.</td></tr>";
            $delflag = 0;
        }
    else
    {
        $display_block = "Read reviews: ";
    }
?>

<?php $page_title = 'Reviews' ?>
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
            <th>Review</th>
            <th>Rating</th>
        </tr>
    
        <?php while($review = mysqli_fetch_assoc($results)) { ?>

        <tr>
            <td><?php echo $review['isbn']; ?></td>
            <td><?php echo $review['title']; ?></td>
            <td><?php echo $review['author']; ?></td>
            <td><?php echo $review['review']; ?></td>
            <td><?php echo $review['rating']; ?></td>
        </tr>

        <?php } ?>

    </table></center>
    <br>
    <div class="actions">
        <button class="action"><a class = "action" href="<?php echo 'add_review.php'?>">Add review</a></button>
    </div>
    
    <?php require('shared/footer.php'); ?> 
