<?php
 ///connect to the server &database
include_once("dbconnect.php");

session_start();

if (isset($_SESSION['loggedin']) != "yes" ) 
{
    $display_block = " You are already logged in! ";
} 

// if login form has been completed
if (isset($_POST["logSubmit"]))
{
    //clean the email address
    $email = filter_var($_POST ["email"], FILTER_SANITIZE_EMAIL);
    $pwd = $_POST["pwd"];

    //query the database for that email address
    $sql = "SELECT u_id, pwd FROM user WHERE email = \"$email\""; 
    $results = mysqli_query($db, $sql) or die (mysqli_error ($db));

        //if that email address is in the database
        if (mysqli_num_rows($results) > 0 )
        {
            $row = mysqli_fetch_array($results);

            //chceck the password - typed vs from database
            $passwordOK = password_verify($pwd, $row['pwd']);

            //if the password is correct
            if ($passwordOK == true)
            {
                
                //log them in
                $display_block = "Login successful! <br>";
                                              
                //add the user id and the email to the session varibles
                $_SESSION["u_id"] = $row["u_id"];
                
                mysqli_query($db, $sql) or die(mysqli_error($db));        
              
            }
            
            else
            {
                //display password error
                $display_block = "That password is incorrect";
                
            }    
            //end if
        }
        else
        {
            $display_block = "
            <h1>That user isn't registered! </h1>
            <br>
            <p class=\"link\"><a class= \"back-link\" href=\"register.php\">New Registration</a></p>
            <br>
            
            ";
            
        }


    }
    
   
    else
    //show the login form
    $display_block = "
    <form action = \"login.php\" method = \"post\">
            <h1>Plase login first:</h1>
            <br>
            <h2><p> <label for=\"email\"> Email: </label><input type = \"text\" id= \"email\" name = \"email\"/required></p></h2>

            <h2><p><label for=\"pass\"> Password: </label><input type = \"password\" id=\"pass\" name = \"pwd\"/required></p></h2>
            
            <p><input type = \"submit\" name = \"logSubmit\" value=\"Log in\"/></p>
            <br>       
            </form>
        ";

?>



<?php $page_title = 'Login' ?>
<?php require('shared/header.php'); ?>

		<p><?php echo $display_block; ?><p>
        <br>
                
<?php require('shared/footer.php'); ?> 