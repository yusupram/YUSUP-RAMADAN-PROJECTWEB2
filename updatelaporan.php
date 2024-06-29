<?php
include "koneksi.php";

$id = $_POST["id"];
$tanggal = $_POST["tanggal"];
$shift = $_POST["shift"];
$bagian = $_POST["bagian"];
$operator = $_POST["operator"];
$team = $_POST["team"];
$no_so = $_POST["no_so"];
$tanggal_so = $_POST["tanggal_so"];
$project = $_POST["project"];
$no_hp = $_POST["no_hp"];
$type_barang = $_POST["type_barang"];
$warna = $_POST["warna"];
$deskripsi = $_POST["deskripsi"];

if ($_FILES['gambar']['size'] > 0) {
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $upload_file = $upload_dir . basename($gambar);
    move_uploaded_file($gambar_tmp, $upload_file);

    $sql = "UPDATE laporan_harian SET tanggal=?, shift=?, bagian=?, operator=?, team=?, no_so=?, tanggal_so=?, project=?, no_hp=?, type_barang=?, warna=?, deskripsi=?, gambar=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssi", $tanggal, $shift, $bagian, $operator, $team, $no_so, $tanggal_so, $project, $no_hp, $type_barang, $warna, $deskripsi, $upload_file, $id);
} else {
    $sql = "UPDATE tokped SET tanggal=?, shift=?, bagian=?, operator=?, team=?, no_so=?, tanggal_so=?, project=?, no_hp=?, type_barang=?, warna=?, deskripsi=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $tanggal, $shift, $bagian, $operator, $team, $no_so, $tanggal_so, $project, $no_hp, $type_barang, $warna, $deskripsi, $id);
}

if ($stmt->execute()) {
    echo "Data berhasil diupdate.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

<div class="col-auto">
    <a class="text-decoration-none text-success mt-3 d-block" href="viewlaporan.php">
        <i class="bi bi-arrow-left"></i> Back To View
    </a>
</div>
