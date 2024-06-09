
<?php
include '../Model/lieu_queries.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        include '../Model/db.php';

        $result = get_all_lieu($conn);

        
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