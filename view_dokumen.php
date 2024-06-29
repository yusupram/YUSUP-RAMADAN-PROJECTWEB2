<?php
include "header.php";
include "koneksi.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID tidak ditemukan.");
}

$sql = "SELECT * FROM laporan_harian WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Data tidak ditemukan.");
}

$conn->close();
?>

<main class="main bg-dark">
    <div class="container bg-dark text-light">
        <div class="card bg-dark text-light border border-success p-5">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="<?php echo $row['gambar']; ?>" class="card-img-top" style="object-fit: cover; height: 400px;" alt="...">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['project']; ?></h5>
                        <p class="card-text">No SO: <?php echo $row['no_so']; ?></p>
                        <p class="card-text">Tanggal SO: <?php echo $row['tanggal_so']; ?></p>
                        <p class="card-text">Project : <?php echo $row['project']; ?></p>
                        <p class="card-text">Type Barang : <?php echo $row['type_barang']; ?></p>
                        <p class="card-text">Warna : <?php echo $row['warna']; ?></p>
                        <p class="card-text">Deskripsi: <?php echo $row['deskripsi']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="editlaporan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="viewlaporan.php" class="btn btn-sm btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php";?>
