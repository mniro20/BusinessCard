<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customersignin.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<style>
    .one {
        background-color: white;
        border-style: solid;
        border-color: black;
        font-size: 300%;
        font-family: "Comfortaa", "Courier New", monospace;
        
    }
    div{
        background-color: white;
        width: 800px;
        border: 800px; 
        border-color: black;
        padding: 20px;
        margin: 15px;
        font-family: "Comfortaa", "Courier New", monospace;
        
    }

    p.smallRight{
        text-align: right;
        font-size: 40%;
        font-family: "Comfortaa", "Courier New", monospace;
    }

</style>

<center>
    <body style = "background-color: rgb(133, 180, 205)"> 
        <h1 class = "one" > BusinessCard 
        <p class = "smallRight" ><b>Hi, <a href="customeraccountpage.php"> <?php echo htmlspecialchars($_SESSION["email_c"]); ?></a> </p>
        <p class = "smallRight"><a href="logout.php">Logout</a></p> </h1>
        

    <div>Welcome to BusinessCard. BusinessCard is a free website where different tradesman can promote their busineesses 
        for customers in their area.

    </div>

    <p> How can we help you today?</p>

    <p><a href = "findbusiness.php">Find a Business</a></p>
    <p><a href="customerviewappointments.php">View Current Appointments.</a></p>
    

    </body>
</center>
</html>