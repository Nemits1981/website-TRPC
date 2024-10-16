<?php
include 'config.php';

// Mendapatkan nilai dari form
$pi_number = isset($_POST['pi_number']) ? $_POST['pi_number'] : '';
$brand = isset($_POST['brand']) ? $_POST['brand'] : '';  
$jenis_product = isset($_POST['jenis_product']) ? $_POST['jenis_product'] : '';  
$size = isset($_POST['size']) ? $_POST['size'] : '';  
$qty = isset($_POST['qty']) ? $_POST['qty'] : '';  
$date = isset($_POST['date']) ? $_POST['date'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';

// Pastikan semua field terisi sebelum melanjutkan query
if (empty($pi_number) || empty($brand) || empty($jenis_product) || empty($size) || empty($qty)) {
    echo "Semua field harus diisi!";
    exit;
}

// Memeriksa apakah data sudah ada di database
$sqlCheck = "SELECT * FROM table_bobind WHERE pi_number = ? AND brand = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("ss", $pi_number, $brand);
$stmtCheck->execute();

$resultCheck = $stmtCheck->get_result();
if ($resultCheck->num_rows > 0) {
    $row = $resultCheck->fetch_assoc();
    $oldQty = $row['qty'];

    // Update qty (add new quantity to the existing one)
    $newQty = $oldQty + $qty;

    // Update data di database
    $sqlUpdate = "UPDATE table_bobind SET qty = ?, jenis_product = ?, size = ?, date = ?, status = ? WHERE pi_number = ? AND brand = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("issssss", $newQty, $jenis_product, $size, $date, $status, $pi_number, $brand);

    if ($stmtUpdate->execute()) {
        echo "Qty berhasil diperbarui dengan nilai baru: $newQty!";
    } else {
        echo "Error saat memperbarui data: " . $conn->error;
    }
} else {
    // Masukkan data baru ke database
    $sqlInsert = "INSERT INTO table_bobind (pi_number, brand, jenis_product, size, qty, date, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ssssiss", $pi_number, $brand, $jenis_product, $size, $qty, $date, $status);

    if ($stmtInsert->execute()) {
        echo "Data baru berhasil ditambahkan!";
    } else {
        echo "Error saat menambahkan data: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
