<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $ageGroup = htmlspecialchars($_POST['age-group']);
    $participants = htmlspecialchars($_POST['participants']);
    $attendedBefore = htmlspecialchars($_POST['attended-before']);
    $eventSource = htmlspecialchars($_POST['event-source']);
    $meal = htmlspecialchars($_POST['meal']);
    $comments = html_entity_decode($_POST['comments']);
    $terms = isset($_POST['terms']) ? 1 : 0;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $servername = "localhost";  
    $username = "root";         
    $password = "";             
    $dbname = "event_registration"; 

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $query = "INSERT INTO registrations (first_name, last_name, email, phone, occupation, age_group, participants, attended_before, event_source, meal, comments, terms_agreed) 
              VALUES ('$firstName', '$lastName', '$email', '$phone', '$occupation', '$ageGroup', '$participants', '$attendedBefore', '$eventSource', '$meal', '$comments', '$terms')";

    if (mysqli_query($conn, $query)) {
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Registration Confirmation</title>
                </head>
                <body>
                    <h1>Registration Successful</h1>
                    <p>Thank you for registering for the event. We look forward to seeing you at the Youth Empowerment Conference!</p>
                    <button><a href='index.html'>Go Back</a></button>
                </body>
                </html>";
    } else {
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Registration Unsuccessful</title>
                </head>
                <body>
                    <h1>Registration Unsuccessful</h1>
                    <p>There was an error processing your registration. Please try again later.</p>
                    <button><a href='index.html'>Go Back</a></button>
                </body>
                </html>";
    }

    mysqli_close($conn);
}
?>
