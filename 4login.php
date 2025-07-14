<?php
 ///connect to the server &database
include_once ('dbconnect.php');

session_start();
if (isset($_SESSION['loggedin']) != "yes") 
{
    $display_log = " You are already logged in! ";
} 

// if login form has been completed
elseif (isset($_POST["logSubmit"]))
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
                $display_log = "Login successful.";
                
                //add the user id and the email to the session varibles
                $_SESSION["u_id"] = $row["u_id"];
            }
            
            else
            {
                //display password error
                $display_log = "That password is incorrect ";

            }    
            
        }
        else
        {
            $display_log = "That user isn't registered!";
            

        }


}
else
    //Sshow the login form
    $display_log = "
        <form action = \"login.php\" method = \"post\">
            <label for=\"email\"> Email: </label>
            <input type = \"text\" id= \"email\" name = \"email\"  required/>
            
            <label for=\"pass\"> Password: </label>
            <input type = \"password\" id=\"pass\" name = \"pwd\"  required/>
            <br>
            <input type = \"submit\" name = \"logSubmit\" value=\"Log in\"/>
        </form>
        
    ";
?>
<?php

    if (isset($_POST["regSubmit"]))
    {
        $email =$_POST["email"];
        $pwd = $_POST["pwd"];
        $pwdConfirm = $_POST["pwdConfirm"]; 
    
        //if the passwords don't match
        if ($pwd != $pwdConfirm)
        {
            //display 0error message
            $display_reg = "Your typed passswords do not match!";   
    
    
        }    
        
        else
        {
            // Saftety first
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
            //query database for giving email adress
            $sql = "SELECT email FROM user WHERE email = \"$email\"";
            $results = mysqli_query($db, $sql) or die (mysqli_error ($db));
    
            $rowCount = mysqli_num_rows($results);
    
    
            //if email is already in database
            if ($rowCount >0)
            {
                //display error message
                $display_reg = "that email has been alredy been used!";
            }

            if ($_POST['email'] == "")
		    {
			// add an error message
			$display_reg = "<p>You need to type the email address</p><p><a href=\"4login.php\">Go back to register</a></p>";
		    }
            
            else
            {
                // encrypt their password
                $pwdEncrypted = password_hash ($pwd, PASSWORD_DEFAULT);
    
                //add them to the database
                $sql = "INSERT INTO user VALUES (NULL, '$email', '$pwdEncrypted')";
                $results = mysqli_query($db, $sql) or die (mysqli_error ($db));
    
                //display a success message
                $display_reg = "User \"$email\" has been created!";
            }
         //endif
    
        }
    }
    
    else
    {
        //show the form
        $display_reg = "
         <form action = \"register.php\" method = \"post\" >

         <label for=\"Remail\"> Email: </label>
         <input type = \"text\" id= \"Remail\" name = \"email\"  required/>

         <label for=\"Rpass\"> Password: </label>
         <input type = \"password\" id= \"Rpass\" name = \"pwd\"  required/>

         <label for=\"passCon\"> Confirm Password: </label>
         <input type = \"password\" id= \"passCon\" name = \"pwdConfirm\"  required/>
         <br>
         <input type = \"submit\" name = \"regSubmit\" value=\"Register Me\"/>
        
        
        ";
        //endif
    
    }


?>


<?php $page_title = 'Login' ?>
<?php require('shared/header.php'); ?>

    <div class="row">
        <div class="column">
            <div id= "left">
                <h1>Please login first: </h1>
                <br>
            <h2><?php echo $display_log; ?></h2>
            <br>
            
            
        </div>
        <br>    
    </div>
    
    <div class="column">
        <div id= "right">
                <h1> If you are new user, please register first: </h1>
                <br>
                <h2><?php echo $display_reg; ?></h2>
                <br>
            </div>                    
               
       </div>

<?php require('shared/footer.php'); ?> 
