<?php
// Koneksi ke database
include 'config.php';

// Ambil data dari form
$pi_number = $_POST['pi_number'];
$man_power = $_POST['man_power'];
$brand = $_POST['brand'];
$result = $_POST['result'];
$date = $_POST['date'];
$status = $_POST['status'];

// Cek apakah data sudah ada di tablefinishing berdasarkan pi_number, brand, dan date
$sqlCheck = "SELECT * FROM tablefinishing WHERE pi_number = ? AND brand = ? AND date = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("sss", $pi_number, $brand, $date);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();


if ($resultCheck->num_rows > 0) {
    echo "Data dengan PI Number: $pi_number, Brand: $brand, dan Date: $date ditemukan. <br>";
    
  
    $sqlUpdate = "UPDATE tablefinishing SET result = result + ? WHERE pi_number = ? AND brand = ? AND date = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("isss", $result, $pi_number, $brand, $date);
    
    if ($stmtUpdate->execute()) {
        echo "Result berhasil diperbarui!";
    } else {
        echo "Error saat memperbarui result: " . $conn->error;
    }
} else {
    echo "Data tidak ditemukan. Menambahkan data baru. <br>";
    
    // Jika data tidak ditemukan, tambahkan data baru ke tablefinishing
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
