
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $lieuId = $_GET['lieuId'];
    
        $env = parse_ini_file('../../.env');

        $servername = $env["SERVER_NAME"];
        $username = $env["USERNAME"];
        $password = $env["PASSWORD"];
        $dbname = $env["DB_NAME"];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM reservation WHERE ID_lieu = $lieuId;";
        $result = mysqli_query($conn,$query);

        
        if ($result->num_rows > 0) {
            // Output data of each row
            $reservations = array();
            while($row = $result->fetch_assoc()) {
                $reservations[] = $row;
            }
            echo json_encode($reservations);
        }else{
            echo json_encode(array());
        }
        $conn->close();
   
    }
?>