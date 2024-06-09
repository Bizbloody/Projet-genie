<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $start = $_GET['start'];
        $end =  $_GET['end'];
        $lieu =  $_GET['lieu'];

        include '../Model/db.php';


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
        $conn->close();
    }
?>