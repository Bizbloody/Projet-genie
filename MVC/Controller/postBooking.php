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
            $lieuId = $reservation_data -> lieuId;
            

            $env = parse_ini_file('../../.env');

            $servername = $env["SERVER_NAME"];
            $username = $env["USERNAME"];
            $password = $env["PASSWORD"];
            $dbname = $env["DB_NAME"];

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $assoID = $_SESSION['ID'];
            //$ID = 5;
            
           
            $status = 'Actif';

            $query = "INSERT INTO reservation (ID_association, ID_lieu, date_debut, date_fin, status, reservation_name) VALUES ($assoID, $lieuId, '$start', '$end', '$status', '$name');";
            echo($query);
            $result = mysqli_query($conn,$query);

            // $stmt1 = $conn->prepare("INSERT INTO reservation (ID_association, ID_lieu, date_debut, date_fin, status, reservation_name) VALUES (?, ?, ?, ?, ?, ?)");
            // $stmt1->bind_param("ssssss", $assoID, $lieuId, $start, $end, $status, $name);
            // $stmt1->execute();
            // $stmt1->close();

            // Fermeture de la connexion
            $conn->close();
        } else {
            // Respond with an error message if the data was not valid JSON
            echo json_encode(array("status" => "error", "message" => "Invalid JSON data."));
        }
    }
    ?>