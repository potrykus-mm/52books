<?php
// connect to the server & database
include_once ("dbconnect.php");

//if form has been filled out
if (isset($_POST["regSubmit"]))
{
    $email =$_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdConfirm = $_POST["pwdConfirm"]; 

    //if the passwords don't match
    if ($pwd != $pwdConfirm)
    {
        //display 0error message
        $display_block = "Your typed passswords do not match!";
      
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
            $display_block = "That email has been alredy been used!";
        }
        
        else
        {
            // encrypt their password
            $pwdEncrypted = password_hash ($pwd, PASSWORD_DEFAULT);

            //add them to the database
            $sql = "INSERT INTO user VALUES (NULL, '$email', '$pwdEncrypted')";
            $results = mysqli_query($db, $sql) or die (mysqli_error ($db));

            //display a success message
            $display_block = "User \"$email\" has been created!";
        }
     //endif

    }
}

else
{
    //show the form
    $display_block = "
     <form action = \"register.php\" method = \"post\">
     <p>Email:<input type = \"text\" name = \"email\"/ required></p>
     <p>Password<input type = \"password\" name = \"pwd\"/  required></p>
     <p>Confirm Password<input type = \"password\" name = \"pwdConfirm\"/  required></p>
     <p><input type = \"submit\" name = \"regSubmit\" value=\"Register Me\"/></p>
    
    
    ";
    //endif

}


?>
<?php $page_title = 'Registered' ?>
<?php require('shared/header.php'); ?>

		<h2><?php echo $display_block; ?></h2>
        <br>
        <p><a class="back-link" href="<?php echo ('4login.php'); ?>">&laquo; Back to Login</a></p>
        <br>
<?php require('shared/footer.php'); ?> 