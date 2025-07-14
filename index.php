<?php
// connect to the server & database
require_once ('dbconnect.php');

if (!isset ($_POST['action']))
{
    //create form block
    $display_block ="
    <form method = \"POST\" action= \"index.php\">
    <p>
    <b><label for=\"email\"> Your email adress:</label></b>
    </p>
    <p>
    <input type= \"text\" id =\"email\" name=\"email\"/>
    </p>
    <p>
    <input type= \"radio\" id =\"sub\" name= \"action\" value = \"sub\" checked/>
    <label for=\"sub\"> Subscribe </label>

    <input type= \"radio\" id =\"unsub\" name= \"action\" value = \"unsub\" />
    <label for=\"unsub\"> Unsubscribe</label>
    </p>
    <br>
    <p>
    <input type =\"submit\" name= \"submit\" value=\"Submit Form\"/>
    </p>
    </form>
    ";
    
}
else if ($_POST['email'] == "")
{
    //print missing email adress
    $display_block = "You haven't added an email adress, please try again ";
}

else if ($_POST['action'] == 'sub')

{
    //trying to subscribe 

    //clean the input data
    $cleanEmail = mysqli_real_escape_string($db, $_POST['email']);
  
    //check to see if that email is alreday in the database
    $sql = "SELECT u_id FROM subscribers WHERE email = \"$cleanEmail\"";
    $results = mysqli_query($db, $sql) or die(mysqli_error ($db));
    $rowCount = mysqli_num_rows($results);

    //if email is not ther 
    if ($rowCount == 0)
    {
        //add it
        $sql = "INSERT INTO subscribers VALUES (NULL, \"$cleanEmail\")";
        mysqli_query($db, $sql) or die(mysqli_error ($db));

        //set a success message
        $display_block = "You' ve been added to the mailing list!";

    }
    else 
    {
        //set a failure message
        $display_block = "You were already in the database.";

    }
    
}
else if ($_POST['action'] == 'unsub')
{
     //trying to unsubscribe,

      //clean the input data
    $cleanEmail = mysqli_real_escape_string($db, $_POST['email']);

     // check if the email adress is in the database
    $sql = "SELECT u_id FROM subscribers WHERE email = \"$cleanEmail\"";
    $results = mysqli_query($db, $sql) or die(mysqli_error ($db));
    $rowCount = mysqli_num_rows($results);

     // if the email is not ther
     if ($rowCount == 0)
     {
        //display an error message
        $display_block = "You weren't subscribed in the first place";
     }
     else 
     {     
        //remove that email address
            //Extract the id from the result
            $row = mysqli_fetch_array($results);
            $u_id = $row[0];
            
            //make an sql delete query using that id
            $sql = "DELETE FROM subscribers WHERE u_id = \"$u_id\"";
            echo $sql;

            //send it to the database
            mysqli_query($db, $sql) or die (mysqli_error($db));

        //display a succes message
        $display_block = "You've been removed from the list";
     }

}
?>
    <?php $page_title = '52 Books Challange' ?>
    <?php require('shared/header.php'); ?>
            
        <div>
            <div class="column">
                <div>
                    <figure>
                        <img class="mySlides" src="graphics/books-1.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-2.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-3.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-4.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-5.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-6.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-7.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-8.jpg" alt="open books" style="width:500px" height="320px"> 
                        <img class="mySlides" src="graphics/books-9.jpg" alt="open books" style="width:500px" height="320px"> 
                    
                    </figure>
                </div>
                <div>
                 <br>
                    <p>
                    Follow The 52 Book Club on social media. You can find us on Facebook, Twitter, and Instagram.
                    <br>
                    The Facebook group is our most popular spot for posting your recent 52 Book Club reads.
                    <br> 
                    When sharing on other social media sites like Instagram or Twitter, don't forget to use the hashtag #the52bookclub2022 and #the52bookclub. 
                    This helps us find everyone!
                    <br>
                    How often you share is up to you! You can share after every read, share all of your reads at the end of the month, 
                    or even just at the end of the year! 
                    Some participants chose to track their reads privately and simply follow along in the groups to find amazing recommendations. 
                    How you decide to participate is up to you. 
                    <br>
                    <b>We're just glad you're here!</b>
                 </p>
                 
                </div>
            </div>
            
            <div class="column">
                <div>
                    <p>
                    What is the challenge? 
                    <br>
                    52 Books in 52 Weeks is an annual challenge made up of 52 unique books. Match one book to each week for a total of 52 books throughout the year. The goal is to try new authors or genres, push ourselves to read more, read differently, and most importantly… to have fun!
                    </p>
                    <br>
                    <br>
                    <h2>Mailing List</h2>                           
                    <br>
                    
                    <div id= "block">
                        <?php echo "$display_block"; ?>
                    </div>   
                
                </div>
                <div>
                    <br>
                    <br>
                    <br>
                    <object>
                        <center><iframe width="560" height="315" src="https://www.youtube.com/embed/-T2v4HmXecQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  </center>      
                    </object>
                    <br>
                    <br>
                    <br>
                </div>    
            </div>
                
            <footer>
                    
                <div class="socialsplit">
                    <div class="socialmedia"><a href="https://en-gb.facebook.com/" target="_blank"><img src="graphics/fb.png" alt="Facebook" class="socialicon"></a></div>
                    <div class="socialmedia"><a href="https://www.instagram.com/" target="_blank"><img src="graphics/insta.png" alt="Instagram" class="socialicon"></a></div>
                    <div class="socialmedia"><a href="https://twitter.com/" target="_blank"><img src="graphics/tweeter.png" alt="Twitter" class="socialicon"></a></div>
                    <div class="socialmedia"><a href="https://uk.linkedin.com/" target="blank"><img src="graphics/linkin.png" alt="LinkedIn" class="socialicon"></a></div>
                </div>
                
                <div id ="copy">
                    <br>
                     &copy; <?php echo date('Y');?> '52 Books Challenge'
                </div>
                
            </footer>
        </div>
                
        <script>
            var slideIndex = 0;
            carousel();
            function carousel() 
            {
              var i;
              var x = document.getElementsByClassName("mySlides");
              for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            slideIndex++;
              if (slideIndex > x.length) {slideIndex = 1}
                  x[slideIndex-1].style.display = "block";
                  setTimeout(carousel, 4000); // Change image every 2 seconds
                }
        </script>    
    
            
    </body>
</html>