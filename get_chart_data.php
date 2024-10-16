<?php
header('Content-Type: application/json');
include 'config.php'; // Koneksi database

// Query untuk tablepi (untuk Order Chart)
$sqlPi = "SELECT product_name, total_order FROM tablepi";
$resultPi = $conn->query($sqlPi);

$tablepi = [];
while ($row = $resultPi->fetch_assoc()) {
    $tablepi[] = $row;
}

// Query untuk tablefinishing (untuk Finishing Chart)
$sqlFinishing = "SELECT brand, result FROM tablefinishing";
$resultFinishing = $conn->query($sqlFinishing);

$tablefinishing = [];
while ($row = $resultFinishing->fetch_assoc()) {
    $tablefinishing[] = $row;
}

// Gabungkan hasil dari kedua tabel ke dalam array
$response = [
    'tablepi' => $tablepi,
    'tablefinishing' => $tablefinishing
];

// Return data dalam format JSON
echo json_encode($response);

// Tutup koneksi
$conn->close();
?>
