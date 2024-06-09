<?php

include '../Model/db.php';

include '../Model/association_queries.php';

$associations = getAssociations($conn);
$conn->close();

header('Content-Type: application/json');
echo json_encode($associations);