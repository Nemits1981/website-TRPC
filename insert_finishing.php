<?php

include 'config.php';


$pi_number = $_POST['pi_number'];
$man_power = $_POST['man_power'];
$brand = $_POST['brand'];
$result = $_POST['result'];
$date = $_POST['date'];
$status = $_POST['status'];


$sqlCheck = "SELECT * FROM tablefinishing WHERE pi_number = ? AND brand = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ss", $pi_number, $brand);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo "Data dengan PI Number: $pi_number dan Brand: $brand ditemukan. <br>";
    

    $row = $resultCheck->fetch_assoc();
    $oldResult = $row['result']; 
    
 
    $newResult = $oldResult + $result;


    $sqlUpdate = "UPDATE tablefinishing SET result = ?, man_power = ?, date = ?, status = ? WHERE pi_number = ? AND brand = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("isssss", $newResult, $man_power, $date, $status, $pi_number, $brand);
    
    if ($stmtUpdate->execute()) {
        echo "Result berhasil diperbarui dengan nilai baru: $newResult!";
    } else {
        echo "Error saat memperbarui result: " . $conn->error;
    }
} else {
    echo "Data tidak ditemukan. Menambahkan data baru. <br>";
    

    $sqlInsert = "INSERT INTO tablefinishing (pi_number, man_power, brand, result, date, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("sisiss", $pi_number, $man_power, $brand, $result, $date, $status);
    
    if ($stmtInsert->execute()) {
        echo "Data baru berhasil ditambahkan!";
    } else {
        echo "Error saat menambahkan data: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
