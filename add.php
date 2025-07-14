<?php
	// connect to the sqlserver and database
	include_once ("dbconnect.php");

	session_start();
	

	if (!isset($_POST['addsubmit'])) // if the submit button hasn't been pressed, we can assume we're going to ask for a new row to add
	{
		$display_block = "
		<form name=\"form1\" method=\"post\" action=\"$_SERVER[PHP_SELF]\">
			<table>	
				<tr>
    				<th>ISBN</th>
    				<th>Title</th>
    				<th>Author</th>
					<th>Read</th>
  				</tr>
				<tr>
					<td>
						<input name = \"isbn\" type=\"integer\" size=\"15\" maxlength=\"14\" />
					</td>
					<td>
						<input name = \"title\" type=\"text\" size=\"54\" maxlength=\"53\" />
					</td>
					<td>
						<input name = \"author\" type=\"text\" size=\"54\" maxlength=\"53\" />
					</td>
					<td align= \"center\">
						<input type=\"hidden\" name=\"devour\" value=\"0\" />
						<input type=\"checkbox\" name=\"devour\" value=\"1\" size=\"5\" maxlength=\"4\" />
					</td>
				</tr>
				<tr>
					<td><label>
						<input type=\"submit\" name=\"addsubmit\" value=\"   Add   \" />
					</label></td>
				</tr>
			</table>
		</form>
		";

			
					
	}

	else // The submit button HAS been pressed, so we should have come from the form being filled out
	{
		
		// if url from form is empty
		if ($_POST['isbn'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type the ISBN number</p><p><a href=\"add.php\">Go back to the add book</a></p>";
		}
		
		else if($_POST['title'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type the Title</p><p><a href=\"add.php\">Go back to the add book</a></p>";
		}

		else if ($_POST['author'] == "")
		{
			// add an error message
			$display_block = "<p>You need to type the Author</p><p><a href=\"add.php\">Go back to the add book</a></p>";
		}

		else
		{
			
			$int_value = $_POST['isbn'] ?? '';
			$isbn = (int)$int_value;
			
			$title = $_POST['title'] ?? '';
			$author = $_POST['author'] ?? '';
			
			$devour = $_POST['devour'] ?? '';
			
						
			$sql = "INSERT INTO booklist ";
			$sql .= "(isbn, title, author, devour) ";
			$sql .= "VALUES ("; 
			
			$sql .= "'" . $isbn . "'," ;
			$sql .= "'" . htmlspecialchars($title, ENT_QUOTES) . "',";
			$sql .= "'" . htmlspecialchars($author, ENT_QUOTES) . "',";
			$sql .= "'" . $devour . "'";
			$sql .= ")";
			
			
			
			$result = mysqli_query($db, $sql) or die (mysqli_error($db)); 
			
			
			$display_block = "<p><b>\"$title\"</b> has beed added! </p>";
			
		}
		
	}
?>


<?php $page_title = 'Add book' ?>
<?php require('shared/header.php'); ?>

<form name="form1" method="post" action="add.php">
	<a class="back-link" href="<?php echo ('2booklist.php'); ?>">&laquo; Back to List</a>
	<br><br>
		
		<center><table>
		
			<?php echo $display_block; ?>
			
		</table></center>

		<br>
		<a class = "logout" href="logout.php">Log me out</a>
	</form>
          <br>
          
		<?php require('shared/footer.php'); ?>
		
    </body>
</html>