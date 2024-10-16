<?php
include('config.php');

// Ambil data dari form
$customer = $_POST['customer'];
$pi_number = $_POST['pi_number'];
$product_name = $_POST['product_name'];
$total_order = $_POST['total_order'];
$deadline = $_POST['deadline'];
$status = $_POST['status'];


// Insert data ke tabel orders
$sql = "INSERT INTO tablepi (customer, pi_number, product_name, total_order, deadline, status) 
        VALUES ('$customer', '$pi_number', '$product_name', '$total_order', '$deadline', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
