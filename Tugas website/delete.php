<?php
$conn = new mysqli('localhost', 'root', '', 'website_db');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Mulai transaction untuk memastikan semua query berhasil
    $conn->begin_transaction();
    
    try {
        // Hapus data
        $sql = "DELETE FROM pendaftar WHERE id='$id'";
        $conn->query($sql);
        
        // Reset auto increment
        $sql_reset = "ALTER TABLE pendaftar AUTO_INCREMENT = 1";
        $conn->query($sql_reset);
        
        // Reorder nomor urut
        $sql_reorder = "SET @number = 0";
        $conn->query($sql_reorder);
        
        $sql_update = "UPDATE pendaftar SET id = @number := @number + 1 ORDER BY id";
        $conn->query($sql_update);
        
        // Commit jika semua query berhasil
        $conn->commit();
        
        header("Location: dashboard.php");
    } catch (Exception $e) {
        // Rollback jika terjadi error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
?>