
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $lieuId = $_GET['lieuId'];

        include '../Model/db.php';
        include '../Model/reservation_queries.php';

        $result = get_all_reservation_by_lieu($conn, $lieuId);

        
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