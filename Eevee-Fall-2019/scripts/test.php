<?php

$conn = new mysqli("127.0.0.1", "root", "", "ghostpost");
$stmt = $conn->prepare("SELECT * FROM posts LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($outp);
?>