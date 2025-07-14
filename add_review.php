<?php
	// connect to the server & database
	include_once ('dbconnect.php');

	session_start();

	if (!isset ($_SESSION["u_id"]))
   {
	   header ("location: login.php");
   }

	// Get all titles from the booklist
	$sql_init = "SELECT * FROM `booklist`";
	$sql_titles = mysqli_query($db,$sql_init);

	if (isset($_POST['addsubmit'])) // The submit button HAS been pressed, so we should have come from the form being filled out
	{
		$display_block = "<p>Trying to add item.</p>";

		// if url from form is empty
		if ($_POST['isbn'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type the ISBN number</p><p><a href=\"add_review.php\">Go back to the add a review</a></p>";
		}
		
		else if($_POST['title'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type the Title</p><p><a href=\"add_review.php\">Go back to the add a review</a></p>";
		}
 		else if ($_POST['review'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type in a review</p><p><a href=\"add_review.php\">Go back to the add a review</a></p>";
		}

		else
		{
		
			$title = $_POST['title'] ?? '';		
			$int_value2 = $_POST['rating'] ?? '';
			$rating = (int)$int_value2;

			// Store the review in a "review" variable 
			$review = mysqli_real_escape_string($db,$_POST['review']); 

			// Store isbn in a "isbn" variable 
			$isbn_txt = mysqli_real_escape_string($db,$_POST['isbn']);
			$isbn = (int)$isbn_txt;
			
			//insert or replace a review entry if already exists
			$sql = "REPLACE INTO review(`isbn`, `review`, `rating`) ";
			//$sql .= "(isbn, review, rating) ";
			$sql .= "VALUES ("; 		
			$sql .= "'" . $isbn . "'," ;
			$sql .= "'" . $review . "',";
			$sql .= "'" . $rating . "'";
			$sql .= ")";

			$results = mysqli_query($db, $sql) or die (mysqli_error($db));
		
			if(mysqli_query($db,$sql))
			{
				echo '<script>alert("Review has been added!")</script>';

			}
		}
	}
	
?>
 
<?php $page_title = 'Add review' ?>
<?php require('shared/header.php'); ?> 

<br><br>
<a class="back-link" href="<?php echo ('3review.php'); ?>">&laquo; Back to Reviews</a>

<form name="form1" method="post" action="add_review.php">

	<br><br>
	<center><table>
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Review</th>
			<th>Rating</th>
	  	</tr>
		<tr>
			<td>
				<input name = "isbn" type="text" size="" maxlength="14" id="isbn" >
			</td>
			<td>			
 				<?php
			 	echo "<select name =\"title\" onchange=\"this.form.isbn.value=this.options[this.selectedIndex].title\" type=\"text\" size=\"\" maxlength=\"14\" id=\"title\" >";
				?>
				<option>Select...</option>
				<?php  
					// use a while loop to fetch data  
					// from the $sql_titles variable  
					// and individually display as an option 
					while ($booklist = mysqli_fetch_array( 
					$sql_titles,MYSQLI_ASSOC)):;  
				?>
				<option value="<?php echo $booklist["isbn"];?>" title="<?php echo $booklist["isbn"];?>" >			
				<?php echo $booklist["title"];?>
				</option> 
				<?php  
				endwhile;  
				// While loop must be terminated 
				?> 
			</select>
			</td>
			<td>
				<input name="review" type="text" size="30" maxlength="500" />
			</td>
			<td>
				<select id="rating" name="rating">
        		<option value="1">1</option>
        		<option value="2">2</option>
        		<option value="3">3</option>
        		<option value="4">4</option>
				<option value="5">5</option>
        		<option value="6">6</option>
        		<option value="7">7</option>
        		<option value="8">8</option>
				<option value="9">9</option>
        		<option value="10">10</option>
        		</select><br>
			</td>
		</tr>
		<tr></tr>
	
	</table></center>
	<label>
		<p><input name="addsubmit" type="submit" value="Add" /></p>
	</label>
	<br>
	<a class = "logout"  href="logout.php">Log me out</a>
</form>
<br>

<?php require('shared/footer.php'); ?>
