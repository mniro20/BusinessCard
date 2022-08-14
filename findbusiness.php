<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to customer sign in page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: customersignin.php");
    exit;
}

?>


<!DOCTYPE html>
<html>
    <head>
    
    </head>
                
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
            width: 600px;
            border: 800px; 
            border-color: black;
            padding: 20px;
            margin: 15px;
            font-family: "Comfortaa", "Courier New", monospace;
            
        }

        .echo{
            background-color: white;
            border-style: solid;
            width: 600px;
            border: 800px; 
            border-color: black;
            padding: 20px;
            margin: 15px;
            font-family: "Comfortaa", "Courier New", monospace;
            text-align: left; 
        }

        p.smallRight{
            text-align: right;
            font-size: 40%;
            font-family: "Comfortaa", "Courier New", monospace;
        }

        input[type=text]{
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-color: black;
            box-sizing: border-box;
        }




    </style>
    


    <center>
    <body style = "background-color: rgb(133, 180, 205)"> 
        <h1 class = "one"> BusinessCard
        <p class = "smallRight"><b>Hi, <a href="customeraccountpage.php"> <?php echo htmlspecialchars($_SESSION["email_c"]); ?></a> </p>
        <p class = "smallRight"><a href="logout.php">Logout</a></p></h1>
        
        <div>Enter the Occupation or Business Name you are looking for.
             After you find a business, you may call the Phone Number shown or 
             fill in the form below to request an appointment. Please copy the business name to fill in the form on the next page.</div>
         
        <form method = "post" action="findbusiness.php">
            Business Name or Occupation: <input type="text" name="choice" required/>
            <input type="submit" value="Search" name = "submit">
        </form>

        <?php // insert data to database
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $conn = mysqli_connect("localhost", "root", "", "businesscarddb");

            if($conn === false){
                die("ERROR: Could not connect. "
                    . mysqli_connect_error());
            }

            // insert data to database

            $choice = $_POST["choice"];

            $sql = "SELECT * FROM business_info WHERE occupation LIKE '%".$choice."%' OR business_name LIKE '%".$choice."%'";

            $results = mysqli_query($conn, $sql);
            
            // fetch data from database
            if (mysqli_num_rows($results) > 0){
                while ($row = mysqli_fetch_array($results)){
                    echo "<br>";
                    echo "<p class = 'echo'>Name: ".$row[1]." ".$row[2].
                    ".<br> Phone Number: ".$row[9].
                    ".<br> Business Name: ".$row[10].
                    ".<br> Occupation: ".$row[11].
                    ".<br> Hourly Rate: $".$row[12].
                    ". <br></p>";
                    echo "<br>";
                    
                }
            }else{
                echo "<p class = 'echo'>No Results found. Try refining your search. </p>";
            }

            mysqli_close($conn);
        }
        ?>


        <form method = 'post' action='bookappointment.php'>
            <input type='submit' value='Schedule Appointment'>
        </form>

        

        <p><a href = "customerhomepage.php">Go back to the homepage</a></p>
    

    </body>
    </center>
</html>