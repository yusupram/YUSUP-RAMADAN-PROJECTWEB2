<?php
include "header.php";
include "koneksi.php";

$search_term = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $sql = "SELECT * FROM laporan_harian WHERE no_so LIKE '%$search_term%' OR project LIKE '%$search_term%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM laporan_harian ORDER BY id DESC";
}

$result = $conn->query($sql);
?>

<main class="main bg-dark">
    <div class="container bg-dark text-light text-center">
        <div class="px-4 py-3 border border-success rounded">
            <h3 class="mb-4">HASIL LAPORAN PROSES</h3>
            <div class="row mb-4">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <form class="mb-3 d-flex justify-content-end" method="GET" action="viewlaporan.php">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari berdasarkan No SO atau Nama Proyek" name="search" value="<?php echo htmlspecialchars($search_term); ?>">
                            <button class="btn btn-outline-success" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SHIFT</th>
                            <th>TANGGAL</th>
                            <th>BAGIAN</th>
                            <th>OPERATOR</th>
                            <th>TEAM</th>
                            <th>NO SO</th>
                            <th>TANGGAL SO</th>
                            <th>PROJECT</th>
                            <th>NO HP</th>
                            <th>TYPE BARANG</th>
                            <th>WARNA</th>
                            <th>DESKRIPSI</th>
                            <th>GAMBAR</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['shift']; ?></td>
                                    <td><?php echo $row['tanggal']; ?></td>
                                    <td><?php echo $row['bagian']; ?></td>
                                    <td><?php echo $row['operator']; ?></td>
                                    <td><?php echo $row['team']; ?></td>
                                    <td><?php echo $row['no_so']; ?></td>
                                    <td><?php echo $row['tanggal_so']; ?></td>
                                    <td><?php echo $row['project']; ?></td>
                                    <td><?php echo $row['no_hp']; ?></td>
                                    <td><?php echo $row['type_barang']; ?></td>
                                    <td><?php echo $row['warna']; ?></td>
                                    <td><?php echo $row['deskripsi']; ?></td>
                                    <td>
                                        <?php if (!empty($row['gambar'])) {?>
                                            <img src="<?php echo $row['gambar']; ?>" class="img-thumbnail" width="100" alt="gambar">
                                        <?php }?>
                                    </td>
                                    <td>
                                    <div class="btn-group p-1" role="group" aria-label="Actions">
                                        <a href="editlaporan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="view_dokumen.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary ms-2">View</a>
                                        <a href="hapuslaporan.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">Hapus</a>
                                    </div>
                                    </td>
                                </tr>
                            <?php }
} else {?>
                            <tr>
                                <td colspan="15" class="text-center">Tidak ada data untuk ditampilkan.</td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <a class="text-decoration-none text-success mt-3" href="home.php">
                Kembali ke Halaman Utama
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</main>

<?php include "footer.php";?>
