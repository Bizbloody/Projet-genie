<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $start = $_GET['start'];
        $end =  $_GET['end'];
        $lieu =  $_GET['lieu'];

        $env = parse_ini_file('.env');

        $servername = $env["SERVER_NAME"];
        $username = $env["USERNAME"];
        $password = $env["PASSWORD"];
        $dbname = $env["DB_NAME"];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT l.ID,l.nom FROM lieu as l INNER JOIN reservation as r on r.ID_lieu = l.ID WHERE r.date_debut >= '".$start."' and r.date_fin <= '".$end."'";
   
        $result = mysqli_query($conn,$query);

        if ($result->num_rows > 0) {
            // Output data of each row
            $places = array();
            while($row = $result->fetch_assoc()) {
                $places[] = $row;
            }
            echo json_encode($places);
        }else{
            echo json_encode(array());
        }
    }
?>