<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo 'login_required';
        exit;
    }

    $id_produs = intval($_POST['id_produs']);
    $id_utilizator = $_SESSION['user_id'];

    $check_product = $conn->prepare("SELECT id FROM produse WHERE id = ?");
    $check_product->bind_param("i", $id_produs);
    $check_product->execute();
    
    if ($check_product->get_result()->num_rows === 0) {
        echo 'product_not_found';
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM cos_cumparaturi WHERE id_utilizator = ? AND id_produs = ?");
    $stmt->bind_param("ii", $id_utilizator, $id_produs);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE cos_cumparaturi SET cantitate = cantitate + 1 WHERE id_utilizator = ? AND id_produs = ?");
        $stmt->bind_param("ii", $id_utilizator, $id_produs);
    } else {
        $stmt = $conn->prepare("INSERT INTO cos_cumparaturi (id_utilizator, id_produs, cantitate) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $id_utilizator, $id_produs);
    }

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $check_product->close();
}
$conn->close();
?>