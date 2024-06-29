<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM laporan_harian WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Laporan berhasil dihapus.";
            header("Location: viewlaporan.php");
            exit();
        } else {
            $_SESSION['message'] = "Terjadi kesalahan saat menghapus laporan.";
        }
        
        $stmt->close();
    }
} else {
    header("Location: viewlaporan.php");
    exit();
}

$conn->close();
?>
