<?php

    session_start();
    
    $conn = new mysqli('localhost', 'root', '', 'projekt_fryzjer');
    

    if($conn->connect_errno!=0)
    {
        echo "Error: ".$conn->connect_errno;
    }

    else 
    {       
        if(isset($_POST['email']))
        {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $option1 = $_POST['option1'];

            

            if($conn->query("INSERT INTO oferta VALUES ('$name', '$lastName', '$email', '$number', '$date', '$time', '$option1' )"))
            {
                $_SESSION['udane']==true;
                header('Location: connect.php');
            }
            else 
            {
                throw new Exception($conn->error);
            }

            
            $conn->close();

    }
}