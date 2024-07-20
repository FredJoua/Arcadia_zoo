<?php
include_once '../dbconn.php';

$sql = "SELECT * FROM horaires";
$stmt = $conn->query($sql);
$jours = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($jours);
echo "</pre>";

$conn = null;
?>
