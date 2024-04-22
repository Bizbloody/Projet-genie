<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $post_data = file_get_contents("php://input");
    
    // Decode the JSON data sent from the client
    $reservation_data = json_decode($post_data);

    // Check if the data was successfully decoded
    if ($reservation_data !== null) {
        // Extract reservation details
        $name = $reservation_data->name;
        $start = $reservation_data->start;
        $end = $reservation_data->end;

      
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projet";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $ID = $_SESSION['ID'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO lieu (ID_association, nom, date_debut, date_fin) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $ID, $name, $start, $end);

        // Execute the statement
        $stmt->execute();

        // Close connection
        $stmt->close();
        $conn->close();

        // Respond with a success message
        echo json_encode(array("status" => "success", "message" => "Reservation saved successfully."));
    } else {
        // Respond with an error message if the data was not valid JSON
        echo json_encode(array("status" => "error", "message" => "Invalid JSON data."));
    }
} else {
    // Respond with an error message if the request method is not POST
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
}
?>
