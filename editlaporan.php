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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form text-light px-4 py-5 border border-success rounded">
                    <h5 class="mb-4">EDIT DOKUMEN</h5>
                    <form action="updatelaporan.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Shift</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="shift" id="shift1" value="1" <?php echo ($row['shift'] == 1) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="shift1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="shift" id="shift2" value="2" <?php echo ($row['shift'] == 2) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="shift2">2</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="bagian" class="form-label">Bagian</label>
                                <input type="text" class="form-control" id="bagian" name="bagian" value="<?php echo $row['bagian']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="operator" class="form-label">Operator</label>
                                <input type="text" class="form-control" id="operator" name="operator" value="<?php echo $row['operator']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="team" class="form-label">Team</label>
                                <input type="text" class="form-control" id="team" name="team" value="<?php echo $row['team']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="no_so" class="form-label">No SO</label>
                                <input type="number" class="form-control" id="no_so" name="no_so" value="<?php echo $row['no_so']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_so" class="form-label">Tanggal SO</label>
                                <input type="date" class="form-control" id="tanggal_so" name="tanggal_so" value="<?php echo $row['tanggal_so']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="project" class="form-label">Project</label>
                                <input type="text" class="form-control" id="project" name="project" value="<?php echo $row['project']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="type_barang" class="form-label">Type Barang</label>
                                <input type="text" class="form-control" id="type_barang" name="type_barang" value="<?php echo $row['type_barang']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="warna" class="form-label">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna" value="<?php echo $row['warna']; ?>">
                            </div>
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"><?php echo $row['deskripsi']; ?></textarea>
                            </div>
                            <div class="col-12">
                                <label for="gambar" class="form-label">Upload Gambar</label>
                                <input class="form-control" type="file" id="gambar" name="gambar" multiple>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                <a href="viewlaporan.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php";?>
