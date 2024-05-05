<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

$name = null;
$start = 3;
$end = 6;

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

        $lieu = 'test';
        $status = 'Actif';

        $stmt1 = $conn->prepare("INSERT INTO reservation (ID_association, ID_lieu, nom, date_debut, date_fin, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("ssssss", $ID, $lieu, $name, $start, $end, $status);
        $stmt1->execute();
        $stmt1->close();

        // Fermeture de la connexion
        $conn->close();

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($places); // Output the result set as JSON

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


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        echo '<script>';
        echo 'console.log("Start Date: ' . $start . '");';
        echo 'console.log("End Date: ' . $end . '");';
        echo '</script>';
      
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projet";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt2 = $conn->prepare("SELECT l.nom FROM lieu as l INNER JOIN reservation as r on r.ID_lieu = l.ID WHERE r.date_debut >= ? and r.date_fin <= ?");
        $stmt2->bind_param("ss", $start, $end);
        $stmt2->execute();
        $stmt2->bind_result($result);

        echo "$result";

        if ($result->num_rows > 0) {
            // Output data of each row
            $places = array();
            while($row = $result->fetch_assoc()) {
                $places[] = $row;
            }
            echo json_encode($places);
        } else {
            echo json_encode(array()); // Return an empty array if no places available
        }

        $stmt2->close();

        // Fermeture de la connexion
        $conn->close();
}
?>
